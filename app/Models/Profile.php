<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'hero_title_1',
        'hero_title_highlight',
        'hero_title_outline',
        'hero_subtitle',
        'profile_photo',
        'logo_image',
        'cv_file',
        'full_name',
        'job_title',
        'birth_place_date',
        'address',
        'email',
        'instagram', // legacy
        'linkedin',  // legacy
    ];
}
