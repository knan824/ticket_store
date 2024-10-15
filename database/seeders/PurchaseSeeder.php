<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Purchase::factory()->count(10)
            ->recycle(User::all())
            ->recycle(Ticket::all())
            ->create();
    }
}
