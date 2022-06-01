<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerifyController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/')->with('message', "Your email was successfully verified");
    }

    public function verifyMessage()
    {
        return view('auth.verify-email');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
