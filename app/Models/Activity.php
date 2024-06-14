<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Activity extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'title',
        'price',
        'description',
        'category_id',
        'status',
        'image',
        'position',
    ];

    protected $casts = [
        'status' => 'boolean',
        'image' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function views(): HasManyThrough
    {
        return $this->hasManyThrough(View::class, Category::class);
    }
}
