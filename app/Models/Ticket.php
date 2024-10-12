<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'quantity',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
