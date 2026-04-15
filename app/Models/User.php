<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // ── Role constants ──
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_TREASURER   = 'treasurer';
    const ROLE_SECRETARY   = 'secretary';
    const ROLE_COUNCILOR   = 'councilor';
    const ROLE_MEMBER      = 'member';

    // ── Permissions per role ──
    // Maps role => array of route name prefixes they can access
    const ROLE_PERMISSIONS = [
        self::ROLE_SUPER_ADMIN => ['*'], // full access
        self::ROLE_TREASURER   => ['budget', 'budget_category', 'inventory', 'inventory_category', 'dashboard', 'profile'],
        self::ROLE_SECRETARY   => ['user', 'feedback', 'project', 'dashboard', 'profile'],
        self::ROLE_COUNCILOR   => ['project', 'feedback', 'dashboard', 'profile'],
        self::ROLE_MEMBER      => ['dashboard', 'profile'],
    ];

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'role',
        'contact_number',
        'date_of_birth',
        'gender',
        'address',
        'password',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ── Role helpers ──
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isTreasurer(): bool
    {
        return $this->role === self::ROLE_TREASURER;
    }

    public function isSecretary(): bool
    {
        return $this->role === self::ROLE_SECRETARY;
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function canAccess(string $routePrefix): bool
    {
        $permissions = self::ROLE_PERMISSIONS[$this->role] ?? [];
        return in_array('*', $permissions) || in_array($routePrefix, $permissions);
    }

    // ── Dashboard redirect after login ──
    public function dashboardRoute(): string
    {
        return 'dashboard'; // all roles land on dashboard, sidebar filters what they see
    }

    public static function getAllUsers()
    {
        return self::all();
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'user_id');
    }
}
