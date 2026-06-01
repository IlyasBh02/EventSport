<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id', 'sport_type_id', 'name', 'lieu', 'date', 'capacite_max', 'description'];

    protected function casts(): array
    {
        return ['date' => 'datetime'];
    }

    public function sportType() { return $this->belongsTo(SportType::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function matchs() { return $this->hasMany(Matchs::class); }
    public function inscriptions() { return $this->hasMany(Inscription::class); }
    public function favorites() { return $this->hasMany(Favorite::class); }

    public function isFull(): bool
    {
        return $this->inscriptions()->where('statut', 'confirmee')->count() >= $this->capacite_max;
    }
}
