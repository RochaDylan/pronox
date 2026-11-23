<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'api_id',
        'competition_id',
        'home_team',
        'away_team',
        'home_team_logo',
        'away_team_logo',
        'status',
        'kickoff_at',
        'home_score',
        'away_score',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }
   
}
