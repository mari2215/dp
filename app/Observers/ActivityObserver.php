<?php

namespace App\Observers;

use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class ActivityObserver
{
    public function saved(Activity $activity): void
    {
        if (ImageKostil::changedzator($activity, 'description')) {
            $newFieldContents = ImageKostil::urlazator($activity->description);
            $prevImages = ImageKostil::urlazator($activity->getOriginal('description'));

            $newImagesArray = ImageKostil::masivizator($newFieldContents);
            $prevImagesArray = ImageKostil::masivizator($prevImages);

            $activity->description = $newFieldContents;
            $activity->saveQuietly();

            $prevImagesArray = array_diff($prevImagesArray, $newImagesArray);

            foreach ($prevImagesArray as $originalFile)
                if (Storage::exists($originalFile))
                    Storage::disk('local')->delete($originalFile);

            ImageKostil::tempclener();
        }
    }

    public function deleted(Activity $activity): void
    {
        if (!is_null($activity->description)) {
            $delImagesArray = ImageKostil::masivizator($activity->description);
            foreach ($delImagesArray as $originalFile)
                if (Storage::exists($originalFile))
                    Storage::disk('local')->delete($originalFile);
        }
    }
    /**
     * Handle the Activity "created" event.
     */
    public function created(Activity $activity): void
    {
        if ($activity->isDirty('description')) {
            $activity->description = ImageKostil::urlazator($activity->description);
            $activity->save();
            ImageKostil::tempclener();
        }
    }
    /**
     * Handle the Activity "updated" event.
     */
    public function updated(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "restored" event.
     */
    public function restored(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "force deleted" event.
     */
    public function forceDeleted(Activity $activity): void
    {
        //
    }
}
