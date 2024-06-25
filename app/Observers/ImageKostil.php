<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class ImageKostil
{
    // Method to extract image URLs from text and return an array
    public static function masivizator($text)
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

    // Method to add class to images in text and return modified text
    public static function addClassToImages($text)
    {
        $flag = false;
        $newText = '';
        for ($i = 0; $i < strlen($text) - 5; $i++) {
            if (substr($text, $i, 9) == 'img src="') {
                $flag = true;
                $i += 9;
                $newText .= 'img class="img-fluid" src="';
            }

            if (substr($text, $i, 5) == '" alt')
                $flag = false;

            if ($flag)
                $newText .= substr($text, $i, 1);
            else
                $newText .= substr($text, $i, 1);
        }
        $newText .= substr($text, $i);
        return $newText;
    }

    public static function arraizator($maybe_arr)
    {
        return is_array($maybe_arr) ? $maybe_arr : json_decode($maybe_arr, true);
    }

    public static function urlazator($prevImages)
    {
        return str_replace(
            'src="images',
            'src="/images',
            str_replace(
                '../',
                '',
                $prevImages
            )
        );
    }

    public static function changedzator($model, $field)
    {
        return ($model->isDirty($field)) && (!empty($model->getOriginal($field)));
    }

    public static function tempclener()
    {
        $directory = 'livewire-tmp';
        if (Storage::disk('local')->exists($directory)) {
            Storage::disk('local')->deleteDirectory($directory);
        }
    }

    public static function contentizator($contentBlocks): array
    {
        $contentBlocks = ImageKostil::arraizator($contentBlocks);
        if (!$contentBlocks) return [];

        $imageUuids = [];
        foreach ($contentBlocks as $block) {
            $data = Arr::get($block, 'data', []);
            if (isset($data['image']))
                $imageUuids[] = $data['image'];

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
}
