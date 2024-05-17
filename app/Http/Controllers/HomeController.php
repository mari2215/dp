<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Psychologist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EducationalQualification;
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
        $event = Event::findOrFail($id);
        $comments = $event->comments()->whereNull('parent_id')->with('replies')->get();
        return view('source.event', compact('event', 'comments'));
    }

    public function storeComment(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $validatedData = $request->validate([
            'comment' => 'required|string|max:255',
            'parent_id' => 'nullable',
            'user_id' => 'nullable',
            'username' => '',
            'email' => 'email',
            'event_id' => 'required|integer',
            'status' => 'nullable',
        ]);

        $userId = Auth::id();
        $username = Auth::user() ? Auth::user()->name : $validatedData['username'];
        $email = Auth::user() ? Auth::user()->email : $validatedData['email'];
        $comment = new Comment([
            'comment' => $validatedData['comment'],
            'user_id' => $userId,
            'parent_id' => $validatedData['parent_id'],
            'event_id' => $validatedData['event_id'],
            'username' => $username,
            'email' => $email,
            'status' => true,
        ]);
        if ($comment->save()) {
            return redirect()->back()->with('success', 'Ваш коментар успішно додано!');
        } else {
            return redirect()->back()->with('error', 'Сталася помилка при збереженні коментаря.');
        }
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
