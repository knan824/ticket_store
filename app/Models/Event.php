<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'address',
        'time',
    ];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
