<?php

namespace App\Observers;

use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class ActivityObserver
{
    public function saved(Activity $psychologist): void
    {
        if (($psychologist->isDirty('description')) && (!empty($psychologist->getOriginal('description')))) {
            // $prevImages = $psychologist->getOriginal('description');

            // $newFieldContents = $psychologist->description;
            // $newFieldContents = str_replace('../',  '', $newFieldContents);
            // $newFieldContents = str_replace('storage/',  '/', $newFieldContents);
            // $psychologist->description = $newFieldContents;
            // $psychologist->save();

            // $prevImagesArray = $this->masivizator($prevImages);
            // $newImagesArray = $this->masivizator($newFieldContents);

            // $prevImagesArray = array_diff($prevImagesArray, $newImagesArray);

            // // dd($prevImagesArray);

            // foreach ($prevImagesArray as $originalFile)
            //     Storage::disk('local')->delete($originalFile);
        }
    }



    public function deleted(Activity $psychologist): void
    {
        // if (!is_null($psychologist->image)) {
        //     $fieldContentsDecoded = $psychologist->image;

        //     if (is_array($fieldContentsDecoded))
        //         $prevImagesArray = $fieldContentsDecoded;
        //     else
        //         $prevImagesArray = json_decode($fieldContentsDecoded);

        //     foreach ($prevImagesArray as $file)
        //         Storage::disk('local')->delete($file);
        // }
    }
    /**
     * Handle the Activity "created" event.
     */
    public function created(Activity $psychologist): void
    {
        if ($psychologist->isDirty('description')) {
            $newFieldContents = $psychologist->description;
            $newFieldContents = str_replace('../',  '', $newFieldContents);
            $newFieldContents = str_replace('storage/',  '/', $newFieldContents);
            $psychologist->description = $newFieldContents;
            $psychologist->save();
        }
    }


    /**
     * Handle the Activity "updated" event.
     */
    public function updated(Activity $psychologist): void
    {
        //
    }

    /**
     * Handle the Activity "deleted" event.
     */
    // public function deleted(Activity $psychologist): void
    // {
    //     //
    // }

    /**
     * Handle the Activity "restored" event.
     */
    public function restored(Activity $psychologist): void
    {
        //
    }

    /**
     * Handle the Activity "force deleted" event.
     */
    public function forceDeleted(Activity $psychologist): void
    {
        //
    }

    private function masivizator($text)
    {
        $flag = false;
        $image = '';
        $img_arr = [];
        for ($i = 0; $i < strlen($text) - 5; $i++) {
            if (substr($text, $i, 5) == 'src="') {
                $flag = true;
                $i += 5;
            }

            if ($flag)
                $image .= substr($text, $i, 1);

            if (substr($text, $i, 5) == '" alt') {
                $flag = false;
                $img_arr[] = $image;
                $image = '';
            }
        }

        return $img_arr;
    }
}
