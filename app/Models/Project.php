<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
   protected $fillable = [
    'title',
    'announcement',
    'file_name',
    'file_path',
    'file_type',
    'user_id',
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
