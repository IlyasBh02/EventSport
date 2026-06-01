<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Inscription;
use App\Models\Matchs;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalEvents'       => Event::count(),
            'totalParticipants' => User::where('role', 'participant')->count(),
            'totalMatchs'       => Matchs::count(),
            'popularEvents'     => Event::withCount(['inscriptions' => fn($q) => $q->where('statut', 'confirmee')])
                                        ->orderByDesc('inscriptions_count')
                                        ->take(5)->get(),
        ]);
    }
}
