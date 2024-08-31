<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function videos()
{
    return $this->hasMany(Video::class);
}



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_activite',
        'description_activite',
        'video_url',
        'photo_path',
    ];
}
