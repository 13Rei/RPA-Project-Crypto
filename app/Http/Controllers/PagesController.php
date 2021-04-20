<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use Illuminate\Support\Facades\Auth;
use App\Users_Currencies;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function getAllCurrencies(){
        if (!Auth::guest()) {
            $user_id = Auth::user()->id;
            $selectedCrypto = Users_Currencies::where('user_id', Auth::user()->id)->get();
        }
        else {
            $user_id = null;
            $selectedCrypto = null;
        }
        $crypto = Currency::all();
        if ($selectedCrypto) {
            return view('pages.currencies')->with(['data'=> $crypto, 'selected'=> $selectedCrypto]);
        }
        else {
            return view('pages.currencies')->with(['data'=> $crypto, 'selected'=> false]);
        }
    }
}
