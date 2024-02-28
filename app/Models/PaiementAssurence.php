<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementAssurence extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'valeur',
        'annee',
        'enfant_id',
    
    ];
    public function enfant()
    {
        return $this->belongsTo(Enfant::class);
    }
}
