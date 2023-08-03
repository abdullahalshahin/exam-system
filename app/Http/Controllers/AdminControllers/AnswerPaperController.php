<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\AnswerPaper;
use App\Models\ExamPaper;
use App\Models\ExamParticipant;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerPaperController extends Controller
{
    public function show_answer_paper(ExamPaper $exam_paper, ExamParticipant $exam_participant) {
        $total_participation = ExamParticipant::where('exam_paper_id', $exam_paper->id)->count();

        return view('admin_panel.answer_papers.index' , compact('exam_paper', 'exam_participant', 'total_participation'));
    }

    public function result_submit(Request $request, ExamPaper $exam_paper, ExamParticipant $exam_participant) {
        $obtained_marks = 0;
        $negative_marks = 0;

        foreach($request->given_answer as $key => $mark) {
            $answer_paper = AnswerPaper::updateOrCreate(
                [
                    'exam_participant_id' => $exam_participant->id,
                    'question_id' => $key
                ], [
                    'marks' => $mark
                ]
            );

            $obtained_marks += $mark;
        }

        $exam_participant->update([
            'obtained_marks' => $obtained_marks,
            'negative_marks' => $negative_marks
        ]);

        return redirect()->to('admin-panel/dashboard/exam-results/'. $exam_paper->id .'/')
                ->with('success', 'Submited Successfully!!!');
    }
}
