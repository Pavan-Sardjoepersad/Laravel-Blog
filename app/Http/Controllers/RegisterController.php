<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    // Create a user
    public function store(){

        $attributes = request()->validate([
            'name' => ['required', 'max:255'] ,
            'username' => ['required', 'max:255', 'min:3', Rule::unique('users','username')] ,
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')] ,
            'password' => ['required', 'min:7', 'max:255']
        ]);

        $user = User::create($attributes);

        //log the user in 
        Auth::login($user);

        return redirect('/')->with('success', 'Your account has been created');
    }
}
