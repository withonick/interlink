<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hobby::create(['name' => 'Sport']);
        Hobby::create(['name' => 'Music']);
        Hobby::create(['name' => 'Reading']);
        Hobby::create(['name' => 'Travelling']);
        Hobby::create(['name' => 'Cooking']);
        Hobby::create(['name' => 'Dancing']);
        Hobby::create(['name' => 'Hiking']);
        Hobby::create(['name' => 'Cycling']);
        Hobby::create(['name' => 'Fishing']);
        Hobby::create(['name' => 'Theatre']);
    }
}
