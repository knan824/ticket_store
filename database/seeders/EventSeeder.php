<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::factory()->count(20)->create();

        $events->each(function ($event) {
            $event->tickets()->attach(Ticket::inRandomOrder()->first());
            $event->organizers()->attach(Organizer::inRandomOrder()->first());
            $event->categories()->attach(Category::inRandomOrder()->first());
        });
    }
}
