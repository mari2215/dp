<?php

namespace App\Observers;

use App\Models\Psychologist;
use Illuminate\Support\Facades\Storage;

class PsychologistObserver
{
    public function saved(Psychologist $psychologist): void
    {
        if (($psychologist->isDirty('image')) && (!empty($psychologist->getOriginal('image')))) {
            $prevImages = $psychologist->getOriginal('image');
            $newFieldContents = $psychologist->image;

            if (is_array($prevImages))
                $prevImagesArray = $prevImages;
            else
                $prevImagesArray = json_decode($prevImages);

            $prevImagesArray = array_diff($prevImagesArray, $newFieldContents);

            foreach ($prevImagesArray as $originalFile)
                Storage::disk('local')->delete($originalFile);
        }

        if (($psychologist->isDirty('subtitle')) && (!empty($psychologist->getOriginal('subtitle')))) {
            $prevImages = $psychologist->getOriginal('subtitle');
            $newFieldContents = $psychologist->subtitle;

            $newFieldContents = str_replace('../',  '', $newFieldContents);
            $newFieldContents = str_replace('src="images',  'src="/images', $newFieldContents);

            $prevImages = str_replace('../',  '', $prevImages);
            $prevImages = str_replace('src="images',  'src="/images', $prevImages);

            $psychologist->subtitle = $newFieldContents;
            $psychologist->saveQuietly();

            $prevImagesArray = $this->masivizator($prevImages);
            $newImagesArray = $this->masivizator($newFieldContents);

            $prevImagesArray = array_diff($prevImagesArray, $newImagesArray);

            foreach ($prevImagesArray as $originalFile)
                if (Storage::exists($originalFile))
                    Storage::disk('local')->delete($originalFile);
        }
    }



    public function deleted(Psychologist $psychologist): void
    {
        if (!is_null($psychologist->image)) {
            $fieldContentsDecoded = $psychologist->image;

            if (is_array($fieldContentsDecoded))
                $prevImagesArray = $fieldContentsDecoded;
            else
                $prevImagesArray = json_decode($fieldContentsDecoded);

            foreach ($prevImagesArray as $file)
                Storage::disk('local')->delete($file);
        }

        if (!is_null($psychologist->subtitle)) {
            $delImagesArray = $this->masivizator($psychologist->subtitle);

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
            $newFieldContents = $psychologist->subtitle;
            $newFieldContents = str_replace('../',  '', $newFieldContents);
            $newFieldContents = str_replace('src="images',  'src="/images', $newFieldContents);
            $psychologist->subtitle = $newFieldContents;
            $psychologist->save();
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

    private function masivizator($text)
    {
        $flag = false;
        $image = '';
        $img_arr = [];
        for ($i = 0; $i < strlen($text) - 5; $i++) {
            if (substr($text, $i, 9) == 'img src="') {
                $flag = true;
                $i += 9;
            }

            if (substr($text, $i, 5) == '" alt') {
                $flag = false;
                $img_arr[] = $image;
                $image = '';
            }

            if ($flag)
                $image .= substr($text, $i, 1);
        }

        return $img_arr;
    }
}
