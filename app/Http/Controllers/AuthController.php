<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = $user = User::where('email', $request->email)->first();

        if (Auth::attempt($credentials) && $user->hasVerifiedEmail()) {
            $request->session()->regenerate();
            return redirect()->intended('/admin')
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

    public function submitResetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|max:12|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('message', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
