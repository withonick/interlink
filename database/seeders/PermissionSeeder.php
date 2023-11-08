<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Enums\Permission as PermissionEnum;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => PermissionEnum::Create->value]);
        Permission::create(['name' => PermissionEnum::Read->value]);
        Permission::create(['name' => PermissionEnum::Update->value]);
        Permission::create(['name' => PermissionEnum::Delete->value]);

    }
}
