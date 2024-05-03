<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Psychologist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'phone',
        'email',
        'instagram',
        'telegram',
        'viber',
        'facebook',
        'youtube_title',
        'video_url',
    ];

}
