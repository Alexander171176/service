<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создание пользователей и присвоение ролей
        $users = [
            [
                'name' => 'Администратор',
                'email' => 'kosolapov1976@gmail.com',
                'password' => Hash::make('password'),
                'role' => '1'
            ],
            [
                'name' => 'Модератор',
                'email' => 'nice.1711@mail.ru',
                'password' => Hash::make('password'),
                'role' => '2'
            ],
            [
                'name' => 'Пользователь',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => '3'
            ]
        ];

        // Начальное значение team_id
        $teamId = 1;

        foreach ($users as $user) {
            $createdUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            // Присвоение роли пользователю с team_id
            if ($user['role']) {
                $createdUser->roles()->attach($user['role'], ['team_id' => $teamId]);
            }

            // Увеличение team_id для следующего пользователя
            $teamId++;
        }
    }
}
