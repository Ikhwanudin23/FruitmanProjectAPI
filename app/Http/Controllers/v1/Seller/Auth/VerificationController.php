<?php

namespace App\Http\Controllers\v1\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Seller;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;

    public function verify(Request $request)
    {
        $id = $request['id'];
        $user = Seller::findOrFail($id);
        $date = date("Y-m-d g:i:s");
        $user->email_verified_at = $date;
        $user->save();
        return response()->json('Email Verified!');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('User already has verified email', 422);
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json('The notification has been resubmitted');
    }
}
