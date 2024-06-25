<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageObserver
{
    public function saved(Page $page): void
    {
        if (ImageKostil::changedzator($page, 'content_blocks'))
            $this->cleanupUnusedImages($page);
    }

    public function deleted(Page $page): void
    {
        $this->deleteAllImages($page);
    }

    protected function cleanupUnusedImages(Page $page): void
    {
        $newImages = ImageKostil::contentizator($page->content_blocks);

        $originalContentBlocks = ImageKostil::arraizator($page->getOriginal('content_blocks'));
        $oldImages = ImageKostil::contentizator($originalContentBlocks);

        $unusedImages = array_diff($oldImages, $newImages);

        foreach ($unusedImages as $imageUuid) {
            $media = Media::where('uuid', $imageUuid)->first();
            if ($media) {
                $media->delete();
            }
        }
    }

    protected function deleteAllImages(Page $page): void
    {
        $contentBlocks =  ImageKostil::arraizator($page->content_blocks);
        $allImageUuids = ImageKostil::contentizator($contentBlocks);

        foreach ($allImageUuids as $imageUuid) {
            $media = Media::where('uuid', $imageUuid)->first();
            if ($media) {
                $media->delete();
            }
        }
    }

    public function created(Page $page): void
    {
    }

    public function updated(Page $page): void
    {
        $this->cleanupUnusedImages($page);
    }

    public function restored(Page $page): void
    {
    }

    public function forceDeleted(Page $page): void
    {
    }
}
