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

    // Налаштування медіафайлів
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }

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
