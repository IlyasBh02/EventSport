<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventService
{
    public function create(array $data): Event
    {
        return Event::create(array_merge($data, ['user_id' => Auth::id()]));
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);
        return $event;
    }

    public function delete(Event $event): void
    {
        $event->delete();
    }

    public function search(?string $sport, ?string $lieu)
    {
        return Event::with('sportType')
            ->when($sport, fn($q) => $q->whereHas('sportType', fn($q) => $q->where('name', 'like', "%$sport%")))
            ->when($lieu, fn($q) => $q->where('lieu', 'like', "%$lieu%"))
            ->latest()
            ->paginate(10);
    }
}
