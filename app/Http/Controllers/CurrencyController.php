<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use Illuminate\Support\Facades\Auth;
use App\Users_Currencies;

class CurrencyController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }

    public function getCurrency($id){
        $currency = Currency::find($id);
        return \view('pages.currency')->with(['currency'=>$currency]);
    }
}
