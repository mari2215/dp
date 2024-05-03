<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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
        'position',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
