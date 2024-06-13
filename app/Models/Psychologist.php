<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Psychologist extends Model
{
    use HasFactory;

    protected $casts = [
        'image' => 'array',
    ];

    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'phone',
        'email',
        'image',
        'instagram',
        'telegram',
        'viber',
        'facebook',
        'youtube_title',
        'video_url',
    ];
}
