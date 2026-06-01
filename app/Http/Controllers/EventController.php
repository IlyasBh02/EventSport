<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\SportType;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(private EventService $service) {}

    public function index(Request $request)
    {
        $events = $this->service->search($request->sport, $request->lieu);
        $sportTypes = SportType::all();
        return view('events.index', compact('events', 'sportTypes'));
    }

    public function create()
    {
        $sportTypes = SportType::all();
        return view('events.create', compact('sportTypes'));
    }

    public function store(EventRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('events.index')->with('success', 'Événement créé.');
    }

    public function show(Event $event)
    {
        $event->load(['sportType', 'matchs.scores', 'inscriptions']);
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $sportTypes = SportType::all();
        return view('events.edit', compact('event', 'sportTypes'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $this->service->update($event, $request->validated());
        return redirect()->route('events.show', $event)->with('success', 'Événement mis à jour.');
    }

    public function destroy(Event $event)
    {
        $this->service->delete($event);
        return redirect()->route('events.index')->with('success', 'Événement supprimé.');
    }
}
