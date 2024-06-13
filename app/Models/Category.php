<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'status',
        'position',
        'image',
    ];

    protected $casts = [
        'status' => 'boolean',
        'image' => 'array',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function bookings(): HasManyThrough
    {
        return $this->hasManyThrough(Booking::class, Event::class);
    }

    public function views(): HasManyThrough
    {
        return $this->hasManyThrough(View::class, Event::class);
    }
}
