<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_image',
        'full_name',
        'job_title',
        'about',
        'cv_file',
    ];
}
