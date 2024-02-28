<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    use HasFactory;

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
    ];
}
