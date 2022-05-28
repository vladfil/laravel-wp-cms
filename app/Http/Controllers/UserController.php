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

        $user = new User($data);
        $user->save();
        Auth::login($user);

        return redirect('/')
            ->with('message', "Hi {$user->user} ! Your email {$user->email} successfully registered");
    }

    public function authenticate(Request $request)
    {
    }
}
