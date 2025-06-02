<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;
    protected $table = 'event_registrations';
    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'event_id',
    ];

    public static function getAllRegistered()
    {
        return self::all();
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
