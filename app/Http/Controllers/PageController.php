<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Response;

class PageController extends Controller
{
    public function index(Page $page)
    {
        if (!$page->isPublished()) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('pages.index', [
            'page' => $page,
        ]);
    }
}
