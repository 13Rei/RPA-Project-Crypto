<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileEdit extends Controller
{
    public function edit(){
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);

            if ($user) {
                return view('auth.edit')->withUser($user);
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect()->back();
        }
    }

    public function update(Request $data){
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
        }

        if ($user) {
            if ($data['name']) {
                $user->name = $data['name'];
            }
            if ($data['email']) {
                $user->email = $data['email'];
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
            $user->save();
            return view('auth.success');
        }
        else {
            return redirect()->back();
        }
    }
}
