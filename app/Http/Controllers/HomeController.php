<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use App\Models\Comment;
use App\Models\Activity;
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

    public function home()
    {
        $events = Event::where('status', true)
            ->orderBy('start', 'desc')
            ->take(3)
            ->get();
        $categories = Category::where('status', true)->withCount('activities')
            ->orderBy('position', 'desc')
            ->get();
        $activities = Activity::where('status', true)->orderBy('position', 'desc')->paginate(4);
        $psychologist = Psychologist::first();
        return view('welcome', compact('events', 'categories', 'activities', 'psychologist'));
    }

    public function search(Request $request)
    {
        $query = $request->input('s');

        $activities = Activity::where('title', 'LIKE', "%{$query}%")->get();
        $events = Event::where('name', 'LIKE', "%{$query}%")->get();
        $categories = Category::where('title', 'LIKE', "%{$query}%")->get();

        if ($activities->isEmpty() && $events->isEmpty() && $categories->isEmpty()) return view('search.negative_results', compact('query'));

        return view('search.results', compact('activities', 'events', 'categories', 'query'));
    }

    public function category($title)
    {
        $category = Category::where('title', $title)
            ->with('activities')
            ->firstOrFail();

        return view('source.category', compact('category'));
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

    public function storeBooking(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $booking = new Booking([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'total_price' => isset($event->price) ? $event->price : 0,
            'notes' => 'Заявка подана',
        ]);
        if ($booking->save()) {
            return redirect()->back()->with('success', 'Ваш коментар успішно додано!');
        } else {
            return redirect()->back()->with('error', 'Сталася помилка при збереженні коментаря.');
        }
    }

    public function markAsRead($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->read = true;
        $booking->save();

        return response()->json(['success' => true]);
    }

    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Коментар успішно видалено');
    }

    public function reject(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking::find($bookingId);
        if ($booking) {
            $booking->status = 'відхилено';
            $booking->notes = 'Запит відхилено';
            $booking->save();

            return response()->json(['success' => true, 'message' => 'Бронювання відхилено.']);
        }
        return response()->json(['success' => false, 'message' => 'Бронювання не знайдено.'], 404);
    }


    public function events(Request $request)
    {
        $rec = Event::where('status', true)->get();
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
        return view('source.category', compact('category'));
    }

    public function activity($id)
    {
        $activity = Activity::where('id', $id)->firstOrFail();
        return view('source.activity', compact('activity'));
    }
}
