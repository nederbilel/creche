<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    use HasFactory;
    public function paiementmois()
    {
        return $this->hasMany(PaiementMoi::class);
    }
    protected $fillable = [
        'nom',
        'date_de_naissance',
        'nom_mere',
        'nom_pere',
        'telephone1',
        'telephone2',
        'travail_pere',
        'travail_mere',
        'vaccin',
        'adresse',
        'maladie',
        'description',
        'picture_path',
        'frais_inscription',
        'sexe',
        'extrait_de_naissance',
        'certif_enfant',
        'cin_parent',
        'caret_enfant',
    ];

}
