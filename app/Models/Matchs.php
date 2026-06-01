<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matchs extends Model
{
    protected $table = 'matchs';
    protected $fillable = ['event_id', 'equipe_a', 'equipe_b', 'date_match'];

    protected function casts(): array
    {
        return ['date_match' => 'datetime'];
    }

    public function event() { return $this->belongsTo(Event::class); }
    public function scores() { return $this->hasMany(Score::class, 'match_id'); }
}
