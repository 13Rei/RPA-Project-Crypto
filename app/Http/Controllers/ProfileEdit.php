<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Fiat;
use Illuminate\Support\Facades\Auth;

class ProfileEdit extends Controller
{
    public function edit(){
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $fiat = Fiat::all();
            if ($user) {
                return view('auth.edit')->withUser($user)->withFiat($fiat);
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
                $oldmail = $user->email;
                $user->email = $data['email'];
                $user->fiat_id = $data['currency'];
                if ($data['email'] != $oldmail) {
                    $user->email_verified_at = null;
                    $user->sendEmailVerificationNotification();
                }
            }
            $user->save();
            return redirect('/home');
        }
        else {
            return redirect()->back();
        }
    }
}
