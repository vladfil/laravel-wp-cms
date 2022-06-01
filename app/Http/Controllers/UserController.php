<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function create()
    {
        return view('user.create');
    }

    public function restore()
    {
        return view('user.restore');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|max:12|confirmed',
        ]);
        $data['password'] = bcrypt($data['password']);

        $user = new User($data);
        $user->save();
        $user->sendEmailVerificationNotification();

        Auth::login($user);

        return redirect('/email/verify')
            ->with('message', "Hi {$user->user}! Please check your email {$user->email}, for verification.");
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
}
