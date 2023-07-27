<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Models\AnswerPaper;
use App\Models\ExamPaper;
use App\Models\ExamParticipant;
use App\Models\Question;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index() {
        $exam_papers = ExamPaper::query()
            ->where('status', "active")
            ->latest()
            ->get();
        
        return view('client_panel.exams.index', compact('exam_papers'));
    }

    public function create(ExamPaper $exam) {
        $bd_timezone = 'Asia/Dhaka';
        $current_timestamp = Carbon::now($bd_timezone)->toDateTimeString();
        $exam_duration = $exam->duration ?? 0;
        
        $exam_participant = ExamParticipant::query()
            ->where([
                ['student_id', Auth::user()->id],
                ['exam_paper_id', $exam->id]
            ])
            ->first();
        
        if ($exam_participant) {
            $exam_participant_entry_time = $exam_participant->entry_time;
        }
        else {
            $exam_participant_data = ExamParticipant::create([
                'student_id' => Auth::user()->id,
                'exam_paper_id' => $exam->id,
                'entry_time' => Carbon::now($bd_timezone)->toDateTimeString(),
            ]);

            foreach ($exam->assigned_question as $a_q) {
                $question = Question::find($a_q->question_id);

                AnswerPaper::create([
                    'exam_participant_id' => $exam_participant_data->id,
                    'question_id' => $a_q->question->id,
                    'type' => $a_q->question->type,
                    'correct_answer' => $a_q->question->correct_answer,
                ]);
            }

            $exam_participant_entry_time = $exam_participant_data->entry_time;
        }

        $entry_timestamp = strtotime($exam_participant_entry_time);
        $current_timestamp = strtotime($current_timestamp);

        $end_timestamp = $entry_timestamp + ($exam_duration * 60);
        $reminder = $end_timestamp - $current_timestamp;

        $hours = floor($reminder / 3600);
        $minutes = floor(($reminder % 3600) / 60);
        $seconds = $reminder % 60;
        
        $reminder_time = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        $exam_property_data = [
            'reminder_time' => ($reminder_time > "0") ? $reminder_time : "00:00:00",
        ];

        return view('client_panel.exams.create', compact('exam', 'exam_property_data'));
    }

    public function store(Request $request, ExamPaper $exam) {
        return $request;
        $bd_timezone = 'Asia/Dhaka';
        $exam_participant = ExamParticipant::query()
            ->where([
                ['student_id', Auth::user()->id],
                ['exam_paper_id', $exam->id]
            ])
            ->first();
        
        $per_question_mark = $exam->per_question_mark ?? 1;
        $per_question_negative_mark = $exam->per_question_negative_mark ?? 0;
        $obtained_marks = 0;
        $negative_marks = 0;

        if ($exam_participant) {
            if ($request->answers) {
                $answer_papers = AnswerPaper::query()
                        ->where('exam_participant_id', $exam_participant->id)
                        ->get();
    
                foreach($answer_papers as $answer_paper) {
                    $answer_paper->update([
                        'given_answer' => NULL
                    ]);
                }
                
                foreach ($request->answers as $question_id => $answer) {
                    $answer_paper = AnswerPaper::updateOrCreate(
                        [
                            'exam_participant_id' => $exam_participant->id,
                            'question_id' => $question_id
                        ], [
                            'given_answer' => $answer
                        ]
                    );
    
                    if ($answer === $answer_paper->correct_answer) {
                        $obtained_marks += $per_question_mark;
                    } else {
                        $obtained_marks -= $per_question_negative_mark;
                        $negative_marks += $per_question_negative_mark;
                    }
                }
            }

            $exam_participant->update([
                'submit_time' => Carbon::now($bd_timezone)->toDateTimeString(),
                'obtained_marks' => $obtained_marks,
                'negative_marks' => $negative_marks
            ]);

            return redirect()->to('client-panel/dashboard/exams')
            ->with('success', 'Submited Successfully!!!');
        }
        else {
            return abort(404);
        }
    }

    public function show_result(ExamPaper $exam) {
        $exam_participant = ExamParticipant::query()
            ->where([
                ['student_id', Auth::user()->id],
                ['exam_paper_id', $exam->id]
            ])
            ->first();

        if ($exam_participant) {
            $total_participation = ExamParticipant::where('exam_paper_id', $exam->id)->count();
            $my_position = ExamParticipant::where('exam_paper_id', $exam->id)
                ->where('obtained_marks', '>', $exam_participant->obtained_marks)
                ->count() + 1;

            return view('client_panel.exams.show_result', compact('exam', 'exam_participant', 'total_participation', 'total_participation', 'my_position'));
        } else {
            return abort(404);
        }
    }
}
