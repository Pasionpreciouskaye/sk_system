<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        try {
            $user = $this->loginService->authenticate($request->validated());

            // Redirect members (non-admin) back to home
            if ($user->role === \App\Models\User::ROLE_MEMBER) {
                return redirect()->route('home')
                    ->with('success', 'You have successfully logged in!');
            }

            return redirect()->route('dashboard')
                ->with('success', 'Welcome back, ' . $user->first_name . '!');

        } catch (\Illuminate\Auth\AuthenticationException $e) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        $this->loginService->logout();

        return redirect()
            ->route('home')
            ->with('success', 'You have successfully logged out!');
    }
}
