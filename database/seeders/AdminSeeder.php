<?php

namespace Database\Seeders;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::create([
            'firstname' => 'Admin',
            'surname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.kz',
            'birthday' => Carbon::now(),
            'gender' => Gender::Male,
            'password' => bcrypt('admin'),
            'last_seen_at' => Carbon::now(),
            ]);

       $user->assignRole(Role::Admin->label());
    }
}
