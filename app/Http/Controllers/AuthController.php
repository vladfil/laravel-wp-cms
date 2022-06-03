<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function restore()
    {
        return view('auth.restore');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = $user = User::where('email', $request->email)->first();

        if (Auth::attempt($credentials) && $user->hasVerifiedEmail()) {
            $request->session()->regenerate();
            return redirect()->intended('/')
                ->with('message', "Hi {$user->name}! Your has successfully authenticated");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

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
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->sendEmailVerificationNotification();
        }

        return back()->with('message', 'Verification link sent!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login')->with('message', 'Logged out successfully');
    }
}
