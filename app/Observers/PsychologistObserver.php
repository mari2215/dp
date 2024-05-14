<?php

namespace App\Observers;

use App\Models\Psychologist;
use Illuminate\Support\Facades\Storage;

class PsychologistObserver
{
    public function saved(Psychologist $psychologist): void
    {
        if ($psychologist->isDirty('image')) {
            $originalFieldContents = $psychologist->getOriginal('image');
            $newFieldContents = $psychologist->image;

            if (is_array($originalFieldContents))
                $originalFieldContentsDecoded = $originalFieldContents;
            else
                $originalFieldContentsDecoded = json_decode($originalFieldContents);

            $originalFieldContentsDecoded = array_diff($originalFieldContentsDecoded, $newFieldContents);

            foreach ($originalFieldContentsDecoded as $originalFile)
                Storage::disk('local')->delete($originalFile);
        }
    }



    public function deleted(Psychologist $psychologist): void
    {
        if (!is_null($psychologist->image)) {
            $fieldContentsDecoded = $psychologist->image;

            if (is_array($fieldContentsDecoded))
                $originalFieldContentsDecoded = $fieldContentsDecoded;
            else
                $originalFieldContentsDecoded = json_decode($fieldContentsDecoded);

            foreach ($originalFieldContentsDecoded as $file)
                Storage::disk('local')->delete($file);
        }
    }
    /**
     * Handle the Psychologist "created" event.
     */
    public function created(Psychologist $psychologist): void
    {
        //
    }

    /**
     * Handle the Psychologist "updated" event.
     */
    public function updated(Psychologist $psychologist): void
    {
        //
    }

    /**
     * Handle the Psychologist "deleted" event.
     */
    // public function deleted(Psychologist $psychologist): void
    // {
    //     //
    // }

    /**
     * Handle the Psychologist "restored" event.
     */
    public function restored(Psychologist $psychologist): void
    {
        //
    }

    /**
     * Handle the Psychologist "force deleted" event.
     */
    public function forceDeleted(Psychologist $psychologist): void
    {
        //
    }
}
