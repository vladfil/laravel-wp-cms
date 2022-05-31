<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Auth::login($user);

        return redirect('/')
            ->with('message', "Hi {$user->user}! Your email {$user->email} successfully registered");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($user = Auth::attempt($credentials)) {
            $user = $user = User::where('email', $request->email)->first();
            $request->session()->regenerate();
            return redirect()->intended('/')
                ->with('message', "Hi {$user->name}! Your has successfully authenticated");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
