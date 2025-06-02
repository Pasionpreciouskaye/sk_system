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
            $this->loginService->authenticate($request->validated());
    
            return redirect()
                ->route('dashboard')
                ->with('success', 'You have successfully logged in!');
        } catch (AuthenticationException $e) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Invalid email or password.']);
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