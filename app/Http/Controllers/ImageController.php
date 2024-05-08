<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ImageController extends BaseController
{
    public function view($folder, $name)
    {
        return response()->file(storage_path('app/images/' . $folder . '/' . $name));
    }
}
