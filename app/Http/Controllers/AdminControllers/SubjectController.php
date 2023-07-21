<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class SubjectController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $subjects = Subject::latest()->get();

        return view('admin_panel.subjects.index', compact('subjects'))
            ->with('i');
    }

    private function data(Subject $subject) {
        return [
            'subject' => $subject
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin_panel.subjects.create', $this->data(new Subject()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'code'          => ['required', 'string', 'max:255', 'unique:subjects'],
            'total_mark'    => ['required', 'numeric'],
            'total_credit'  => ['required', 'numeric'],
            'inputState'    => ['required', 'string', 'max:255'],
        ]);

        if ($module_file = $request->file('module_file')) {
            $module_file_extension = $module_file->getClientOriginalExtension();

            $destination_path = 'subjects/';
            $module_file_name = "module_file" . "_" .date('YmdHis') . "." . $module_file_extension;
            $module_file->move($destination_path, $module_file_name);
            $module_file_name = "$module_file_name";
        }

        if ($lecturer_sheet_file = $request->file('lecturer_sheet_file')) {
            $lecturer_sheet_file_extension = $lecturer_sheet_file->getClientOriginalExtension();

            $destination_path = 'subjects/';
            $lecturer_sheet_file_name = "lecturer_sheet_file" . "_" .date('YmdHis') . "." . $lecturer_sheet_file_extension;
            $lecturer_sheet_file->move($destination_path, $lecturer_sheet_file_name);
            $lecturer_sheet_file_name = "$lecturer_sheet_file_name";
        }

        Subject::create([
            'name'          => $request->name,
            'code'          => $request->code,
            'total_mark'    => $request->total_mark,
            'total_credit'  => $request->total_credit,
            'module_file'   => ($request->file('module_file')) ? $module_file_name : NULL,
            'lecturer_sheet_file' => ($request->file('lecturer_sheet_file')) ? $lecturer_sheet_file_name : NULL,
            'status'        => $request->inputState,
        ]);

        return redirect()->to('admin-panel/dashboard/subjects')
            ->with('success', 'Subject Created Successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject) {
        return view('admin_panel.subjects.show', $this->data($subject));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject) {
        return view('admin_panel.subjects.edit', $this->data($subject));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject) {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'total_mark'    => ['required', 'numeric'],
            'total_credit'  => ['required', 'numeric'],
            'inputState'    => ['required', 'string', 'max:255'],
        ]);

        if ($module_file = $request->file('module_file')) {
            $module_file_extension = $module_file->getClientOriginalExtension();

            $destination_path = 'subjects/';
            $module_file_name = "module_file" . "_" .date('YmdHis') . "." . $module_file_extension;
            $module_file->move($destination_path, $module_file_name);
            $module_file_name = "$module_file_name";
        }

        if ($lecturer_sheet_file = $request->file('lecturer_sheet_file')) {
            $lecturer_sheet_file_extension = $lecturer_sheet_file->getClientOriginalExtension();

            $destination_path = 'subjects/';
            $lecturer_sheet_file_name = "lecturer_sheet_file" . "_" .date('YmdHis') . "." . $lecturer_sheet_file_extension;
            $lecturer_sheet_file->move($destination_path, $lecturer_sheet_file_name);
            $lecturer_sheet_file_name = "$lecturer_sheet_file_name";
        }

        $subject->update([
            'name'          => $request->name,
            'total_mark'    => $request->total_mark,
            'total_credit'  => $request->total_credit,
            'module_file'   => ($request->file('module_file')) ? $module_file_name :  $subject->module_file,
            'lecturer_sheet_file' => ($request->file('lecturer_sheet_file')) ? $lecturer_sheet_file_name :  $subject->lecturer_sheet_file,
            'status'        => $request->inputState,
        ]);

        return redirect()->to('admin-panel/dashboard/subjects')
            ->with('success', 'Subject Update Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject) {
        if ($subject->questions->count()) {
            return redirect()->to('admin-panel/dashboard/subjects')
                ->with('success', 'This Item Cannot be Deleted. Because, There Are Many Questions Under This Subject');
        }

        $subject->delete();

        return redirect()->to('admin-panel/dashboard/subjects')
            ->with('success', 'Subject Delete Successfully!!!');
    }
}
