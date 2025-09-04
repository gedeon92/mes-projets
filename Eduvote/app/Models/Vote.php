<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    // Liste des colonnes pouvant être remplies automatiquement
    protected $fillable = ['user_id', 'candidat_id'];

    // Relation avec l'utilisateur (user_id)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le candidat (candidat_id)
    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }
}
