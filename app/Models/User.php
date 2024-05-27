<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    // ...

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, 'ekopersonal@ukr.net');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_google_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRegistrationForEvent($eventId)
    {
        return $this->bookings()->where('event_id', $eventId)->exists();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
