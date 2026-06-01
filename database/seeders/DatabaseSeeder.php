<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Favorite;
use App\Models\Inscription;
use App\Models\Matchs;
use App\Models\Score;
use App\Models\SportType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@eventsport.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        $organisateur = User::create([
            'name'     => 'Organisateur',
            'email'    => 'orga@eventsport.com',
            'password' => Hash::make('password'),
            'role'     => 'organisateur',
        ]);

        $participant = User::create([
            'name'     => 'Participant',
            'email'    => 'participant@eventsport.com',
            'password' => Hash::make('password'),
            'role'     => 'participant',
        ]);

        // Sport types
        $sports = collect(['Football', 'Basketball', 'Tennis', 'Marathon', 'Volleyball'])
            ->map(fn($name) => SportType::create(['name' => $name]));

        // Events
        $event1 = Event::create([
            'user_id'       => $organisateur->id,
            'sport_type_id' => $sports[0]->id,
            'name'          => 'Tournoi de Football Universitaire',
            'lieu'          => 'Stade Municipal, Casablanca',
            'date'          => now()->addDays(10),
            'capacite_max'  => 50,
            'description'   => 'Tournoi annuel inter-universités.',
        ]);

        $event2 = Event::create([
            'user_id'       => $organisateur->id,
            'sport_type_id' => $sports[3]->id,
            'name'          => 'Marathon de la Ville',
            'lieu'          => 'Centre-ville, Rabat',
            'date'          => now()->addDays(20),
            'capacite_max'  => 200,
            'description'   => 'Course de 42km ouverte à tous.',
        ]);

        // Match
        $match = Matchs::create([
            'event_id'   => $event1->id,
            'equipe_a'   => 'Équipe Alpha',
            'equipe_b'   => 'Équipe Beta',
            'date_match' => now()->addDays(10),
        ]);

        Score::create(['match_id' => $match->id, 'score_a' => 2, 'score_b' => 1]);

        // Inscription
        Inscription::create(['user_id' => $participant->id, 'event_id' => $event1->id, 'statut' => 'confirmee']);

        // Favorite
        Favorite::create(['user_id' => $participant->id, 'event_id' => $event2->id]);
    }
}
