<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Fiat;
use App\Currency;
use App\Users_Currencies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileEdit extends Controller
{
    public function edit(){
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $fiat = Fiat::all();
            $crypto = Currency::all();
            $selectedCrypto = Users_Currencies::where('user_id', Auth::user()->id)->get();
            if ($user) {
                return view('auth.edit')->withUser($user)->with(['fiat'=> $fiat,'crypto'=> $crypto, 'selectedCrypto'=> $selectedCrypto]);
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect()->back();
        }
    }

    public function deleteAllByUser(){
        $deleteCrypto = Users_Currencies::where('user_id', Auth::user()->id)->delete();
        return redirect('/profile/edit');
    }

    public function update(Request $data){
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
        }

        if ($user) {
            $deleteCrypto = Users_Currencies::where('user_id', Auth::user()->id)->delete();
            if ($data['name']) {
                $user->name = $data['name'];
            }
            if ($data['email']) {
                $oldmail = $user->email;
                $user->email = $data['email'];
                $user->fiat_id = $data['currency'];
                if ($data['cryptocurrencies'] != 0) {
                    foreach ($data['cryptocurrencies'] as $value) {
                        Users_Currencies::create([
                            'user_id'=>Auth::user()->id,
                            'currency_id'=>$value
                        ]);
                    }
                    if ($data['email'] != $oldmail) {
                        $user->email_verified_at = null;
                        $user->sendEmailVerificationNotification();
                    }
                }
            }
            $user->save();
            return redirect('/profile/edit');
        }
        else {
            return redirect()->back();
        }
    }
}
