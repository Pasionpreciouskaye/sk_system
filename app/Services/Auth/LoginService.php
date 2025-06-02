<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class LoginService
{

    public function authenticate(array $data): User
    {
        if (Auth::attempt($data)) {
            request()->session()->regenerate();
            return Auth::user();
        }

        throw new AuthenticationException('Invalid login credentials.');
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    public function store(array $data): User
    {
        return User::create($data);
    }

    public function update(array $data, User $user): void 
    {
        $user->update($data);
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }
}