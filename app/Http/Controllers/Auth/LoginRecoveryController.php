<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LoginRecuperado;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class LoginRecoveryController extends Controller
{
    public function create(): View
    {
        return view('auth.recover-login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->first();
        
        Mail::to($user->email)->send(new LoginRecuperado($user));

        return back()->with('status', 'Enviamos seu login por email.');
    }
}