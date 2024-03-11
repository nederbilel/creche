<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementMoi extends Model
{

    use HasFactory;

    protected $fillable = [
        'date',
        'valeur',
        'annee',
        'mois',
        'enfant_id',
    
    ];
    public function enfant()
    {
        return $this->belongsTo(Enfant::class);
    }
}
