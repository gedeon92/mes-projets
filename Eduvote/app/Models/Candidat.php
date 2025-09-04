<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'filiere_id', 'programme'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}

