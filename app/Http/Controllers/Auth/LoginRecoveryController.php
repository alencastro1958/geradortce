<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LoginRecuperado;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Este email não está cadastrado no sistema.']);
        }

        try {
            Mail::to($user->email)->send(new LoginRecuperado($user));
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar email de recuperação: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Erro ao enviar email. Tente novamente mais tarde.']);
        }

        return back()->with('status', 'Enviamos seu login por email.');
    }
}