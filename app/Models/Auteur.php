<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'nom',
        'prenom',
        'nationalite',
        'date_naissance',
        'biographie',
        'email',
        'telephone',
    ];
     protected $casts = [
        'date_naissance' => 'date',
    ];
    
     public function livres()
    {
        return $this->hasMany(Livre::class);
    }
}
