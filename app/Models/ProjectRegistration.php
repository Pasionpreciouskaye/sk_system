<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRegistration extends Model
{
    use HasFactory;

    protected $table = 'project_registrations';

    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
