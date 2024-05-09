<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
