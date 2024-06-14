<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'end',
        'description',
        'location',
        'price',
        'category_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function views(): HasManyThrough
    {
        return $this->hasManyThrough(View::class, Category::class);
    }
}
