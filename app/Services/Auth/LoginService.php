<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\AuthenticationException;

class LoginService
{
    private const MAX_ATTEMPTS     = 5;
    private const LOCKOUT_SECONDS  = 900; // 15 minutes

    public function __construct(private AuthLogger $logger) {}

    // ── Cache key for attempt tracking ──
    private function throttleKey(string $email): string
    {
        return 'login_attempts:' . strtolower($email) . '|' . request()->ip();
    }

    private function isLockedOut(string $email): bool
    {
        return (bool) Cache::get($this->throttleKey($email) . ':locked', false);
    }

    private function getAttempts(string $email): int
    {
        return (int) Cache::get($this->throttleKey($email), 0);
    }

    private function incrementAttempts(string $email): int
    {
        $key      = $this->throttleKey($email);
        $attempts = $this->getAttempts($email) + 1;
        Cache::put($key, $attempts, self::LOCKOUT_SECONDS);

        if ($attempts >= self::MAX_ATTEMPTS) {
            Cache::put($key . ':locked', true, self::LOCKOUT_SECONDS);
            $this->logger->loginLocked($email, request()->ip());
        }

        return $attempts;
    }

    private function clearAttempts(string $email): void
    {
        $key = $this->throttleKey($email);
        Cache::forget($key);
        Cache::forget($key . ':locked');
    }

    public function authenticate(array $data): User
    {
        $email = strtolower($data['email'] ?? '');
        $ip    = request()->ip();

        // Block locked accounts immediately
        if ($this->isLockedOut($email)) {
            $this->logger->loginBlocked($email, $ip);
            throw new AuthenticationException(
                'Too many failed login attempts. Please try again in 15 minutes.'
            );
        }

        if (Auth::attempt(['email' => $email, 'password' => $data['password']])) {
            request()->session()->regenerate();
            $this->clearAttempts($email);
            $this->logger->loginSuccess($email, $ip);

            $user = Auth::user();
            Cache::put("user_profile:{$user->id}", $user, 600);

            try {
                \App\Models\AuditTrail::create([
                    'user_id'     => $user->id,
                    'action'      => 'login',
                    'module'      => 'Auth',
                    'description' => "Logged in from {$ip}",
                    'ip_address'  => $ip,
                    'changes'     => [['field' => 'Session', 'before' => 'None', 'after' => 'Active']],
                ]);
            } catch (\Throwable $e) {}

            return $user;
        }

        $attempts = $this->incrementAttempts($email);
        $this->logger->loginFailed($email, $ip, $attempts);

        throw new AuthenticationException('Invalid login credentials.');
    }

    public function logout(): void
    {
        $user = Auth::user();
        if ($user) {
            $this->logger->logout($user->email, request()->ip());
            try {
                \App\Models\AuditTrail::create([
                    'user_id'     => $user->id,
                    'action'      => 'logout',
                    'module'      => 'Auth',
                    'description' => "Logged out from " . request()->ip(),
                    'ip_address'  => request()->ip(),
                    'changes'     => [['field' => 'Session', 'before' => 'Active', 'after' => 'None']],
                ]);
            } catch (\Throwable $e) {}
            Cache::forget("user_profile:{$user->id}");
        }

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
        Cache::forget("user_profile:{$user->id}");
    }

    public function destroy(User $user): void
    {
        Cache::forget("user_profile:{$user->id}");
        $user->delete();
    }
}
