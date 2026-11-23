<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'visibility',
        'invitation_code',
        'competition_id',
        'created_by',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }
}
