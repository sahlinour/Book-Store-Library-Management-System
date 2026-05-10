<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'isbn',
        'annee_publication',
        'genre',
        'description',
        'resume',
        'langue',
        'nombre_exemplaires',
        'disponible',
        'image_couverture',
        'auteur_id',
    ];

    protected $casts = [
        'disponible'         => 'boolean',
        'nombre_exemplaires' => 'integer',
    ];
    
    public function auteur()
    {
        return $this->belongsTo(Auteur::class);
    }

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }

}
