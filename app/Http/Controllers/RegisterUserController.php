<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        //validate
        $attributes = request()->validate([
            'first_name'  => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required','in:admin,instructor,student']
        ]);

        //create the user
        $user = User::create($attributes);

        //log in
        Auth::login($user);

        //redirect
        return redirect('/')->with('success', 'Account created successfully!');
    }
}
