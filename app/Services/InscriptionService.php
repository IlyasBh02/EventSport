<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;

class InscriptionService
{
    public function inscrire(Event $event): Inscription|string
    {
        if ($event->isFull()) {
            return 'Cet événement est complet.';
        }

        $existing = Inscription::where('user_id', Auth::id())
            ->where('event_id', $event->id)->first();

        if ($existing) {
            if ($existing->statut === 'confirmee') return 'Vous êtes déjà inscrit.';
            $existing->update(['statut' => 'confirmee']);
            return $existing;
        }

        return Inscription::create([
            'user_id'  => Auth::id(),
            'event_id' => $event->id,
            'statut'   => 'confirmee',
        ]);
    }

    public function annuler(Inscription $inscription): void
    {
        $inscription->update(['statut' => 'annulee']);
    }
}
