<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class EducationalQualification extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'degree',
        'institution',
        'start_date',
        'graduation_date',
        'status',
        'position',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
