<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->with('event.sportType')->get();
        return view('favorites.index', compact('favorites'));
    }

    public function store(Event $event)
    {
        Favorite::firstOrCreate(['user_id' => Auth::id(), 'event_id' => $event->id]);
        return back()->with('success', 'Ajouté aux favoris.');
    }

    public function destroy(Event $event)
    {
        Favorite::where('user_id', Auth::id())->where('event_id', $event->id)->delete();
        return back()->with('success', 'Retiré des favoris.');
    }
}
