<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Psychologist extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->useDisk('public');
    }
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
