<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'event_id',
        'parent_id',
        'username',
        'email',
        'status',
    ];
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeAuth(Builder $builder): Builder
    {
        return $builder->whereNotNull('user_id');
    }

    public function scopeNonauth(Builder $builder): Builder
    {
        return $builder->whereNull('user_id');
    }
}
