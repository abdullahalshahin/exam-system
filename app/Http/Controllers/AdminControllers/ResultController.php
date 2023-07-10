<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\ExamPaper;
use App\Models\ExamParticipant;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request) {
        $exam_papers = ExamPaper::query()
            ->has('exam_participants')
            ->latest()
            ->get();

        return view('admin_panel.results.index', compact('exam_papers'));
    }

    function show(ExamPaper $exam_paper) {
        $exam_participants = ExamParticipant::query()
            ->where('exam_paper_id', $exam_paper->id)
            ->get();
        
        return view('admin_panel.results.show', compact('exam_paper', 'exam_participants'));
    }

    function show_exam_participant(ExamPaper $exam_paper, ExamParticipant $exam_participant) {
        $total_participation = ExamParticipant::where('exam_paper_id', $exam_paper->id)->count();
        $position = ExamParticipant::where('exam_paper_id', $exam_paper->id)
                ->where('obtained_marks', '>', $exam_participant->obtained_marks)
                ->count() + 1;

        return view('admin_panel.results.exam_participant_result', compact('exam_paper', 'exam_participant', 'total_participation', 'position'));
    }
}
