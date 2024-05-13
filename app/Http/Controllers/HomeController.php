<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EducationalQualification;
use App\Models\Event;
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
        $qualifications = EducationalQualification::all();

        return view('source.about-me', compact('psychologist', 'qualifications'));
    }

    public function category($title)
    {
        $category = Category::where('title', $title)
            ->with('activities')
            ->firstOrFail();

        return view('source.author-single', compact('category'));
    }

    public function event($id)
    {
        $event = Event::where('id', $id)->first();
        if (!$event) {
            return abort(404);
        }
        return view('source.event', compact('event'));
    }


    public function events(Request $request)
    {
        $rec = Event::all();
        $events = [];
        foreach ($rec as $ev) {
            $events[] = [
                'id'    => $ev->id,
                'title' => $ev->name,
                'start' => $ev->start,
                'end'   => $ev->end,
                'backgroundColor' => '#00d97d',
                'url' => '/event/' . $ev->id . '',
            ];
        }

        return view('source.events', compact('events'));
    }

    public function show($id)
    {
        $category = Category::with('activities')
            ->where('id', $id)->firstOrFail();

        return view('source.author-single', compact('category'));
    }
}
