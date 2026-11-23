<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_id',
        'name',
        'country',
    ];

    public function games()
    {
        return $this->hasMany(Game::class, 'competition_id');
    }
}
