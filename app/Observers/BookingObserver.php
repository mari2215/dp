<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class BookingObserver
{
    public function saved(Booking $booking): void
    {
        if (ImageKostil::changedzator($booking, 'status')) {
            $booking->read = false;
            $booking->saveQuietly();
        }
    }

    public function deleted(Booking $activity): void
    {
    }
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $activity): void
    {
    }
    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $activity): void
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     */
    public function restored(Booking $activity): void
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     */
    public function forceDeleted(Booking $activity): void
    {
        //
    }
}
