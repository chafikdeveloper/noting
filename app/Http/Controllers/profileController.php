<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class profileController extends Controller
{
    public function index() {
        return inertia('profile');
    }

    public function updateInfo() {
        $user = Auth::user();
        $validated = request()->validate([
            'name' => ['string', 'required', 'min:3', 'max:20'],
            'email' => ['string', 'required', 'email', 'max:128', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->update($validated);

        return back();
    }

    public function updatePassword() {
        $user = Auth::user();
        $validated = request()->validate([
            'current_password' => ['string', 'required', 'current_password'],
            'new_password' => ['string', 'required', 'min:5', 'max:20', 'confirmed']
        ]);

        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return back();
    }
}
