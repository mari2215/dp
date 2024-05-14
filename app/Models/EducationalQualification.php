<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'degree',
        'institution',
        'start_date',
        'graduation_date',
        'image',
        'status',
        'position',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
