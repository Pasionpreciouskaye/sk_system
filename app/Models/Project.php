<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'file_name',
        'file_path'
    ];

    public static function getAllProjects()
    {
        return self::all();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
