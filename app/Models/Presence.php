<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = ['annee', 'date', 'presence'];
}
