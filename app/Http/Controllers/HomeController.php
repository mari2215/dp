<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use App\Models\Psychologist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function about()
    {
        $psychologist = Psychologist::first();
        return view('source.about-me', compact('psychologist'));
    }

    public function category($title)
    {
        $category = Category::where('title', $title)
            ->with('activities')
            ->firstOrFail();

        return view('source.author-single', compact('category'));
    }

    public function show($id)
    {
        $category = Category::with('activities')
            ->where('id', $id)->firstOrFail();

        return view('source.author-single', compact('category'));
    }
}
