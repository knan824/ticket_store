<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'address',
        'time',
        'description',
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

    public function image()
    {
        return $this->morphOne(Image::class, 'mediable');
    }

    public function remove()
    {
        return DB::transaction(function () {
            $this->tickets()->delete();
            $this->image()->delete();
            $this->organizers()->detach();
            $this->categories()->detach();
            $this->delete();
        });
    }
}
