<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Log;

class AuthLogger
{
    public function loginSuccess(string $email, string $ip): void
    {
        Log::channel('auth')->info('Login successful', [
            'email' => $email,
            'ip'    => $ip,
            'time'  => now()->toDateTimeString(),
        ]);
    }

    public function loginFailed(string $email, string $ip, int $attempts): void
    {
        Log::channel('auth')->warning('Login failed', [
            'email'    => $email,
            'ip'       => $ip,
            'attempts' => $attempts,
            'time'     => now()->toDateTimeString(),
        ]);
    }

    public function loginLocked(string $email, string $ip): void
    {
        Log::channel('security')->warning('Account locked out', [
            'email' => $email,
            'ip'    => $ip,
            'time'  => now()->toDateTimeString(),
        ]);
    }

    public function loginBlocked(string $email, string $ip): void
    {
        Log::channel('security')->error('Login attempt on locked account', [
            'email' => $email,
            'ip'    => $ip,
            'time'  => now()->toDateTimeString(),
        ]);
    }

    public function logout(string $email, string $ip): void
    {
        Log::channel('auth')->info('Logout', [
            'email' => $email,
            'ip'    => $ip,
            'time'  => now()->toDateTimeString(),
        ]);
    }
}
