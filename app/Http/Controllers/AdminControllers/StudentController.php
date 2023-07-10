<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $students = User::query()
            ->where('user_type', "CLIENT")
            ->latest()
            ->get();
        
        return view('admin_panel.students.index', compact('students'))
            ->with('i');
    }

    private function data(User $student) {
        return [
            'student' => $student,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin_panel.students.create', $this->data(new User()));
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
            'gender'        => ['required', 'string', 'max:20'],
            'mobile_number' => ['required', 'string', 'max:15', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'address'       => ['required', 'string'],
            'inputState'    => ['required', 'string']
        ]);

        if ($profile_image = $request->file('profile_image')) {
            $extension = $profile_image->getClientOriginalExtension();

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
                $destination_path = 'images/clients/';
                $profile_image_name = date('YmdHis') . "." . $profile_image->getClientOriginalExtension();
                $profile_image->move($destination_path, $profile_image_name);
                $profile_image_name = "$profile_image_name";
            }
        }

        User::create([
            'user_type'     => "CLIENT",
            'name'          => $request->name,
            'mobile_number' => $request->mobile_number,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'security'      => $request->password,
            'gender'        => $request->gender,
            'address'       => $request->address,
            'profile_image' => $request->file('profile_image') ? $profile_image_name : NULL,
            'status'        => $request->inputState,
        ]);

        return redirect()->to('admin-panel/dashboard/students')
            ->with('success', 'Student Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function show(User $student) {
        return view('admin_panel.students.show', $this->data($student));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student) {
        return view('admin_panel.students.edit', $this->data($student));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $student) {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'gender'        => ['required', 'string', 'max:20'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'address'       => ['required', 'string'],
            'inputState'    => ['required', 'string']
        ]);

        if ($profile_image = $request->file('profile_image')) {
            $extension = $profile_image->getClientOriginalExtension();

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
                $destination_path = 'images/clients/';
                $profile_image_name = date('YmdHis') . "." . $profile_image->getClientOriginalExtension();
                $profile_image->move($destination_path, $profile_image_name);
                $profile_image_name = "$profile_image_name";
            }
        }

        $student->update([
            'name'          => $request->name,
            'password'      => Hash::make($request->password),
            'security'      => $request->password,
            'gender'        => $request->gender,
            'address'       => $request->address,
            'profile_image' => $request->file('profile_image') ? $profile_image_name : $student->profile_image,
            'status'        => $request->inputState,
        ]);

        return redirect()->to('admin-panel/dashboard/students')
            ->with('success', 'Student Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student) {
        $student->delete();
        
        return redirect()->to('admin-panel/dashboard/students')
            ->with('success', 'Student Delete Successfully.');
    }
}
