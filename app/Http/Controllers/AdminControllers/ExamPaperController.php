<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\ExamPaper;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamPaperController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $exam_papers = ExamPaper::query()
            ->latest()
            ->get();

        return view('admin_panel.exam_papers.index', compact('exam_papers'))
            ->with('i');
    }

    private function data(ExamPaper $examPaper) {
        return [
            'subjects' => Subject::query()
                            ->where('status', "Active")
                            ->latest()
                            ->get(['id', 'name', 'code']),
            'exam_paper' => $examPaper
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin_panel.exam_papers.create', $this->data(new ExamPaper()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name'                      => ['required', 'string', 'max:255'],
            'subject_id'                => ['required', 'numeric', 'max:20'],
            'description'               => ['required', 'string'],
            'duration'                  => ['required', 'numeric', 'max:10'],
            'total_mark'                => ['required'],
            'per_question_mark'         => ['required'],
            'per_question_mark'         => ['required'],
            'exam_entry_description'    => ['required', 'string'],
            'result_publish_time'       => ['required'],
            'status'                    => ['required', 'string', 'max:255'],
        ]);

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamPaper  $examPaper
     * @return \Illuminate\Http\Response
     */
    public function show(ExamPaper $examPaper) {
        return view('admin_panel.exam_papers.show', $this->data($examPaper));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamPaper  $examPaper
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamPaper $examPaper) {
        return view('admin_panel.exam_papers.edit', $this->data($examPaper));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamPaper  $examPaper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamPaper $examPaper) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamPaper  $examPaper
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamPaper $examPaper) {
        $examPaper->delete();

        return redirect()->to('admin-panel/dashboard/exam-papers')
            ->with('success', 'Exam Paper Delete Successfully!!!');
    }

    public function exam_paper_assigned_question_create_or_delete(Request $request) {
        //
    }
}
