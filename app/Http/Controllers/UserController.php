<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.index', [
            'menuList' => auth()->user()->getMenuList(),
            'users' => User::filter(request(['s']))->paginate(20),
            'search' => $request->s,
        ]);
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
            ->with('message', "Hi {$user->name}! Please check your email {$user->email}, for verification.");
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);

        return $user->update($request->all()) ?
            back()->with('message', "User {$user->name} successfully updated") :
            back()->withErrors(['email' => 'User not updated']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('message', 'User deleted successfully');
    }
}
