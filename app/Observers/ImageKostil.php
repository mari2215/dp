<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;

class ImageKostil
{
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

    public static function arraizator($maybe_arr)
    {
        if (is_array($maybe_arr))
            return $maybe_arr;
        else
            return json_decode($maybe_arr);
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
}
