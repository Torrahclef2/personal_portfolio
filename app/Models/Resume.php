<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'job_title',
        'summary',
        'image',
        'email',
        'phone_number', 
        'address',
        'cv_link',
        'linkedin_link',
        'github_link',
        'age',
        'total_experience',
        'education',
        'total_project',
        'total_clients',
    ];
}
