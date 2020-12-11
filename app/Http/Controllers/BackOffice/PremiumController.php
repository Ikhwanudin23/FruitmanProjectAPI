<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Premium;
use App\Seller;
use App\User;

class PremiumController extends Controller
{
    public function index()
    {
        $premiums = Premium::whereHas('user', function($user){
            $user->where('premium', false);
        })->orWhereHas('seller', function($user){
            $user->where('premium', false);
        })->get();

        return view('pages.premium', [
            'datas' => $premiums,
        ]);
    }

    public function confirmed($id)
    {
        $prem = Premium::where('id', $id)->first();
        if ($prem->user_id) {
            User::where('id', $prem->user_id)->update([
                'premium' => true
            ]);
        }else{
            Seller::where('id', $prem->seller_id)->update([
                'premium' => true
            ]);
        }

        return redirect()->route('premium.index')->with('success', 'berhasil mengkonfirmasi user menjadi premium');
        
    }
}
