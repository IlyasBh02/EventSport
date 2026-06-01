<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Matchs;
use App\Models\Score;

class MatchService
{
    public function create(Event $event, array $data): Matchs
    {
        return $event->matchs()->create($data);
    }

    public function update(Matchs $match, array $data): Matchs
    {
        $match->update($data);
        return $match;
    }

    public function saveScore(Matchs $match, array $data): Score
    {
        return Score::updateOrCreate(
            ['match_id' => $match->id],
            $data
        );
    }
}
