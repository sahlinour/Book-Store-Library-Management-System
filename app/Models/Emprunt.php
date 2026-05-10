<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    use HasFactory;
    protected $fillable = [
        'livre_id',
        'user_id',
        'date_emprunt',
        'date_retour',
        'statut',
        'prolongation',
        'notes',
    ];

    protected $casts = [
        'date_emprunt' => 'date',
        'date_retour'  => 'date',
        'prolongation' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }

    public function scopeEnCours($query) {
        return $query->where('statut', 'en_cours');
    }

    public function scopeEnRetard($query) {
        return $query->where('statut', 'en_retard');
    }

    public function scopeRetournes($query) {
        return $query->where('statut', 'retourne');
    }
}









