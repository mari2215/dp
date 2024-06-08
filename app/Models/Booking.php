<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'total_price',
        'payment_status',
        'notes',
        'read',
    ];

    const STATUS_PENDING = 'опрацьовується';
    const STATUS_REJECTED = 'відхилено';
    const STATUS_CONFIRMED = 'підтверджено';

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Опрацьовується',
            self::STATUS_REJECTED => 'Відхилено',
            self::STATUS_CONFIRMED => 'Підтверджено',
            default => 'Невідомий',
        };
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
        'read' => 'boolean',
        'payment_status' => 'boolean',
    ];
}
