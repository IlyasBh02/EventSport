<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;
use App\Http\Requests\ScoreRequest;
use App\Models\Event;
use App\Models\Matchs;
use App\Services\MatchService;

class MatchController extends Controller
{
    public function __construct(private MatchService $service) {}

    public function create(Event $event)
    {
        return view('matchs.create', compact('event'));
    }

    public function store(MatchRequest $request, Event $event)
    {
        $this->service->create($event, $request->validated());
        return redirect()->route('events.show', $event)->with('success', 'Match planifié.');
    }

    public function edit(Event $event, Matchs $match)
    {
        return view('matchs.edit', compact('event', 'match'));
    }

    public function update(MatchRequest $request, Event $event, Matchs $match)
    {
        $this->service->update($match, $request->validated());
        return redirect()->route('events.show', $event)->with('success', 'Match mis à jour.');
    }

    public function score(Event $event, Matchs $match)
    {
        return view('matchs.score', compact('event', 'match'));
    }

    public function saveScore(ScoreRequest $request, Event $event, Matchs $match)
    {
        $this->service->saveScore($match, $request->validated());
        return redirect()->route('events.show', $event)->with('success', 'Score enregistré.');
    }
}
