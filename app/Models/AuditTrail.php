<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditTrail extends Model
{
    protected $fillable = [
        'user_id', 'action', 'module', 'description', 'ip_address', 'changes',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log(string $action, string $module, string $description, ?array $changes = null): void
    {
        try {
            static::create([
                'user_id'    => Auth::id(),
                'action'     => $action,
                'module'     => $module,
                'description'=> $description,
                'ip_address' => request()->ip(),
                'changes'    => $changes,
            ]);
        } catch (\Throwable $e) {
            // Silently fail if table doesn't exist yet
        }
    }

    public function getActionColorAttribute(): string
    {
        return match(strtolower($this->action)) {
            'login'  => '#F59E0B',
            'logout' => '#6B7280',
            'create' => '#22C55E',
            'update' => '#3B82F6',
            'delete' => '#EF4444',
            default  => '#9CA3AF',
        };
    }
}
