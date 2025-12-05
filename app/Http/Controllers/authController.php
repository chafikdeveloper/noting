<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index()
    {
        return inertia('auth/register');
    }

    public function render()
    {
        return inertia('auth/login');
    }

    public function register()
    {
        $validated = request()->validate([
            'name' => ['string', 'required', 'max:50'],
            'email' => ['string', 'required', 'email', 'max:128', 'unique:users,email'],
            'password' => ['string', 'required', 'min:3', 'max:20']
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function login()
    {
        $credentials = request()->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt($credentials, request()->boolean('remember'))) {
            request()->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
