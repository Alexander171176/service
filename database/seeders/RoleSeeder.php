<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Проверяем, существует ли роль "admin"
        if (!Role::where('name', 'admin')->exists()) {
            // Если роль "admin" не существует, создаем ее
            Role::create(['name' => 'admin']);
        }
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'user']);
    }
}
