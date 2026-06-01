<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Inscription;
use App\Services\InscriptionService;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    public function __construct(private InscriptionService $service) {}

    public function store(Event $event)
    {
        $result = $this->service->inscrire($event);
        if (is_string($result)) {
            return back()->with('error', $result);
        }
        return back()->with('success', 'Inscription confirmée.');
    }

    public function destroy(Inscription $inscription)
    {
        if ($inscription->user_id !== Auth::id()) abort(403);
        $this->service->annuler($inscription);
        return back()->with('success', 'Inscription annulée.');
    }

    public function mesInscriptions()
    {
        $inscriptions = Auth::user()->inscriptions()->with('event.sportType')->get();
        return view('inscriptions.index', compact('inscriptions'));
    }
}
