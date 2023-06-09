<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function my_account() {
        $client = Auth::user();

        return view('client_panel.profile.index', compact('client'));
    }
    
    public function my_account_edit() {
        $client = Auth::user();

        return view('client_panel.profile.edit', compact('client'));
    }

    public function my_account_update(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string'],
        ]);

        $client = Auth::user();

        if ($profile_image = $request->file('profile_image')) {
            if ($client->profile_image) {
                unlink('images/clients/' . $client->profile_image);
            }

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

        User::find($client->id)->update([
            'name'          => $request->name,
            'password'      => Hash::make($request->password),
            'security'      => $request->password,
            'address'       => $request->address,
            'profile_image' => $request->file('profile_image') ? $profile_image_name : $client->profile_image
        ]);

        return redirect()->to('client-panel/dashboard/my-account')
            ->with('success', "Profile Update Successfully!!!");
    }
}
