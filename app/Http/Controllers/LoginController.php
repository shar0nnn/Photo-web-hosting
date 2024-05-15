<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('authentication.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            return redirect()->route('main');
        }

        return back()->withErrors('Неправильний email чи пароль');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('main');
    }
}
