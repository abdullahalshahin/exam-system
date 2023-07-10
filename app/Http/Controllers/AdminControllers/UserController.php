<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::query()
                    ->where('user_type', "ADMIN")
                    ->latest()
                    ->get();
        
        return view('admin_panel.users.index', compact('users'))
            ->with('i');
    }

    private function data(User $user) {
        return [
            'user'  => $user,
            'roles' => Role::get(['id', 'name'])
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin_panel.users.create', $this->data(new User()));
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
                $destination_path = 'images/users/';
                $profile_image_name = date('YmdHis') . "." . $profile_image->getClientOriginalExtension();
                $profile_image->move($destination_path, $profile_image_name);
                $profile_image_name = "$profile_image_name";
            }
        }

        $user = User::create([
            'user_type'     => "ADMIN",
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

        if ($request->role_ids) {
            $user->assignRole($request->role_ids);
        }

        return redirect()->to('admin-panel/dashboard/users')
            ->with('success', 'User Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('admin_panel.users.show', $this->data($user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        return view('admin_panel.users.edit', $this->data($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
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
                $destination_path = 'images/users/';
                $profile_image_name = date('YmdHis') . "." . $profile_image->getClientOriginalExtension();
                $profile_image->move($destination_path, $profile_image_name);
                $profile_image_name = "$profile_image_name";
            }
        }

        $user->update([
            'name'          => $request->name,
            'password'      => Hash::make($request->password),
            'security'      => $request->password,
            'gender'        => $request->gender,
            'address'       => $request->address,
            'profile_image' => $request->file('profile_image') ? $profile_image_name : $user->profile_image,
            'status'        => $request->inputState,
        ]);

        if ($request->roles) {
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            $user->assignRole($request->roles);
        }

        return redirect()->to('admin-panel/dashboard/users')
            ->with('success', 'User Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $user->delete();

        return redirect()->to('admin-panel/dashboard/users')
            ->with('success', 'User Delete Successfully!!!');
    }
}
