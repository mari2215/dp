<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{
    public function saved(Category $category): void
    {
        if (ImageKostil::changedzator($category, 'image')) {
            $prevImagesArray = ImageKostil::arraizator($category->getOriginal('image'));

            $prevImagesArray = array_diff($prevImagesArray, $category->image);

            foreach ($prevImagesArray as $originalFile)
                Storage::disk('local')->delete($originalFile);
        }
        if (ImageKostil::changedzator($category, 'description')) {
            $newFieldContents = ImageKostil::urlazator($category->description);
            $prevImages = ImageKostil::urlazator($category->getOriginal('description'));

            $newImagesArray = ImageKostil::masivizator($newFieldContents);
            $prevImagesArray = ImageKostil::masivizator($prevImages);
            $newFieldContents = ImageKostil::addClassToImages($newFieldContents);

            $category->description = $newFieldContents;
            $category->saveQuietly();

            $prevImagesArray = array_diff($prevImagesArray, $newImagesArray);

            foreach ($prevImagesArray as $originalFile)
                if (Storage::exists($originalFile))
                    Storage::disk('local')->delete($originalFile);

            ImageKostil::tempclener();
        }
    }

    public function deleted(Category $category): void
    {
        if (!is_null($category->image)) {
            $prevImagesArray = ImageKostil::arraizator($category->image);
            foreach ($prevImagesArray as $file)
                Storage::disk('local')->delete($file);
        }
        if (!is_null($category->description)) {
            $delImagesArray = ImageKostil::masivizator($category->description);
            foreach ($delImagesArray as $originalFile)
                if (Storage::exists($originalFile))
                    Storage::disk('local')->delete($originalFile);
        }
    }
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        if ($category->isDirty('description')) {
            $category->description = ImageKostil::urlazator($category->description);
            $category->save();
            ImageKostil::tempclener();
        }
    }
    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
