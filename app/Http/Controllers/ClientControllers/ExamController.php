<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Models\AnswerPaper;
use App\Models\ExamPaper;
use App\Models\ExamParticipant;
use Carbon\Carbon;
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
        $exam_participant = ExamParticipant::query()
            ->where([
                ['student_id', Auth::user()->id],
                ['exam_paper_id', $exam->id]
            ])
            ->first();
        
        if (!$exam_participant) {
            $exam_participant_data = ExamParticipant::create([
                'student_id' => Auth::user()->id,
                'exam_paper_id' => $exam->id,
                'entry_time' => Carbon::now()->toDateTimeString(),
            ]);

            foreach ($exam->assigned_question as $a_q) {
                AnswerPaper::create([
                    'exam_participant_id' => $exam_participant_data->id,
                    'question_id' => $a_q->question_id
                ]);
            }
        }

        return view('client_panel.exams.create', compact('exam'));
    }

    public function store(Request $request, ExamPaper $exam) {
        return $request;
    }
}
