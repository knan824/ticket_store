<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
