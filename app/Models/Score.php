<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['match_id', 'score_a', 'score_b'];

    public function match() { return $this->belongsTo(Matchs::class, 'match_id'); }
}
