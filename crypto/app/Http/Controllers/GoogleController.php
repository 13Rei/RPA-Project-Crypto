<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\User;

class GoogleController extends Controller
{
    use VerifiesEmails;

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {
     
            $user = Socialite::driver('google')->user();
      
            $finduser = User::where('social_id', $user->id)->first();
      
            if($finduser){
      
                Auth::login($finduser);
     
                return view('pages.index');      
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at'=>Carbon::now(),
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    // 'email_verified_at' => date('Y-m-d H:i:s'),
                    'password' => encrypt('my-google')
                ]);

                
                Auth::login($newUser);

                $newUser->markEmailAsVerified();
                return view('pages.index');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('signed')->only('verify');
    //     $this->middleware('throttle:6,1')->only('verify', 'resend');
    // }
}
