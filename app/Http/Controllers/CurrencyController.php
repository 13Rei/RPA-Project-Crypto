<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use Illuminate\Support\Facades\Auth;
use App\Users_Currencies;

class CurrencyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getCurrency($id){
        $selectedCrypto = Users_Currencies::where('user_id', Auth::user()->id)->get();
        $currency = Currency::find($id);
        return \view('pages.currency')->with(['currency'=>$currency, 'selected'=>$selectedCrypto]);
    }

    function followCurrency($id){
        Users_Currencies::create([
            'user_id'=> Auth::user()->id,
            'currency_id'=> $id
        ]);

        return redirect('/currencies');
    }

    function unfollowCurrency($id){
        $toDelete = Users_Currencies::where('user_id', Auth::user()->id)->where('currency_id', $id)->delete();
    
        return redirect('/currencies');
    }
}
