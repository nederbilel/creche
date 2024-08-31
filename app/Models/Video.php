<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activite_id', // Assuming you want to allow mass assignment for the foreign key as well
        'path',
    ];

    /**
     * Get the activite that owns the video.
     */
    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
}
