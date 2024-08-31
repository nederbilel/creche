<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['activite_id', 'path'];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
}
