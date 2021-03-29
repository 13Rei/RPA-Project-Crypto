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

    public function update(){
        
    }
}
