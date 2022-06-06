<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', ['menuList' => auth()->user()->getMenuList()]);
    }

    public function create()
    {
        return view('user.create');
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
}
