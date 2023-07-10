<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string'],
        ]);

        if ($profile_image = $request->file('profile_image')) {
            $extension = $profile_image->getClientOriginalExtension();

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
                $destination_path = 'images/clients/';
                $profile_image_name = date('YmdHis') . "." . $profile_image->getClientOriginalExtension();
                $profile_image->move($destination_path, $profile_image_name);
                $profile_image_name = "$profile_image_name";
            }
            else {
                $profile_image_name = NULL;
            }
        }

        $user = User::create([
            'user_type'     => "CLIENT",
            'name'          => $request->name,
            'mobile_number' => $request->mobile_number,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'security'      => $request->password,
            'gender'        => $request->gender,
            'address'       => $request->address,
            'profile_image' => $request->file('profile_image') ? $profile_image_name : NULL,
            'status'        => "active"
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::CLIENT_HOME);
    }
}
