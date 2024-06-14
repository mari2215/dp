<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageObserver
{
    public function saved(Page $page): void
    {
        $this->cleanupUnusedImages($page);
    }

    public function deleted(Page $page): void
    {
        $this->deleteAllImages($page);
    }

    protected function cleanupUnusedImages(Page $page): void
    {
        $newImages = $this->extractImageUuidsFromContentBlocks($page->content_blocks);

        $originalContentBlocks = ImageKostil::arraizator($page->getOriginal('content_blocks'));
        $oldImages = $this->extractImageUuidsFromContentBlocks($originalContentBlocks);

        if (!is_array($newImages)) {
            $newImages = [];
        }

        if (!is_array($oldImages)) {
            $oldImages = [];
        }
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
        $allImageUuids = $this->extractImageUuidsFromContentBlocks($contentBlocks);

        foreach ($allImageUuids as $imageUuid) {
            $media = Media::where('uuid', $imageUuid)->first();
            if ($media) {
                $media->delete();
            }
        }
    }

    protected function extractImageUuidsFromContentBlocks($contentBlocks): array
    {
        $contentBlocks =  ImageKostil::arraizator($contentBlocks);

        if (!$contentBlocks) {
            return [];
        }

        $imageUuids = [];

        foreach ($contentBlocks as $block) {
            $data = Arr::get($block, 'data', []);
            if (isset($data['image'])) {
                $imageUuids[] = $data['image'];
            }
            if (isset($data['call_to_action'])) {
                foreach ($data['call_to_action'] as $cta) {
                    if (isset($cta['image'])) {
                        $imageUuids[] = $cta['image'];
                    }
                }
            }
        }

        return $imageUuids;
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
