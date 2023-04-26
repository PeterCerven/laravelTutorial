<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show register/create user form
    public function create()
    {
        return view('users.register');
    }

    // Create new User
    public function store(Request $request) {
        $formData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required','email',Rule::unique('users', 'email')],
            'password' => 'required|min:8|confirmed',
        ]);

        $formData['password'] = bcrypt($formData['password']);

        $user = User::create($formData);

        // login
        auth()->login($user);

        return redirect('/')->with('message', 'Your account has been created and you have been logged in.');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        $formData = $request->validate([
            'email' => ['required','email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($formData)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You have been logged in.');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');
    }


}
