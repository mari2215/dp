<?php

namespace App\Observers;

use App\Models\Psychologist;
use App\Observers\ImageKostil;
use Illuminate\Support\Facades\Storage;

class PsychologistObserver
{
    public function saved(Psychologist $psychologist): void
    {
        if (ImageKostil::changedzator($psychologist, 'image')) {
            $prevImagesArray = ImageKostil::arraizator($psychologist->getOriginal('image'));

            $prevImagesArray = array_diff($prevImagesArray, $psychologist->image);

            foreach ($prevImagesArray as $originalFile)
                Storage::disk('local')->delete($originalFile);
        }

        if (ImageKostil::changedzator($psychologist, 'subtitle')) {
            $newFieldContents = ImageKostil::urlazator($psychologist->subtitle);
            $prevImages = ImageKostil::urlazator($psychologist->getOriginal('subtitle'));

            $newImagesArray = ImageKostil::masivizator($newFieldContents);
            $prevImagesArray = ImageKostil::masivizator($prevImages);

            $psychologist->subtitle = $newFieldContents;
            $psychologist->saveQuietly();

            $prevImagesArray = array_diff($prevImagesArray, $newImagesArray);

            foreach ($prevImagesArray as $originalFile)
                if (Storage::exists($originalFile))
                    Storage::disk('local')->delete($originalFile);

            ImageKostil::tempclener();
        }
    }

    public function deleted(Psychologist $psychologist): void
    {
        if (!is_null($psychologist->image)) {
            $prevImagesArray = ImageKostil::arraizator($psychologist->image);
            foreach ($prevImagesArray as $file)
                Storage::disk('local')->delete($file);
        }

        if (!is_null($psychologist->subtitle)) {
            $delImagesArray = ImageKostil::masivizator($psychologist->subtitle);
            foreach ($delImagesArray as $originalFile)
                if (Storage::exists($originalFile))
                    Storage::disk('local')->delete($originalFile);
        }
    }
    /**
     * Handle the Psychologist "created" event.
     */
    public function created(Psychologist $psychologist): void
    {
        if ($psychologist->isDirty('subtitle')) {
            $psychologist->subtitle = ImageKostil::urlazator($psychologist->subtitle);
            $psychologist->save();
            ImageKostil::tempclener();
        }
    }


    /**
     * Handle the Psychologist "updated" event.
     */
    public function updated(Psychologist $psychologist): void
    {
        //
    }

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
