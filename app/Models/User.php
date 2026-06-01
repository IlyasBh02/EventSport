<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isOrganisateur(): bool { return $this->role === 'organisateur'; }
    public function isParticipant(): bool { return $this->role === 'participant'; }

    public function inscriptions() { return $this->hasMany(Inscription::class); }
    public function favorites() { return $this->hasMany(Favorite::class); }
    public function events() { return $this->hasMany(Event::class); }
}
