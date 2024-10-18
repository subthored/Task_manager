<?php

namespace Database\Seeders;

//use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Label;
use App\Models\Task;

use function Laravel\Prompts\password;
use function Laravel\Prompts\table;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = now();

        DB::table('users')->insert([
            ['name' => 'user1', 'email' => 'user1@mail.com', 'password' => Hash::make('852456'), 'created_at' => $now],
            ['name' => 'user2', 'email' => 'user2@mail.com', 'password' => Hash::make('852456'), 'created_at' => $now],
            ['name' => 'user3', 'email' => 'user3@mail.com', 'password' => Hash::make('852456'), 'created_at' => $now]
        ]);

        DB::table('task_statuses')->insert([
            ['name' => 'новый', 'created_at' => $now],
            ['name' => 'в работе', 'created_at' => $now],
            ['name' => 'на тестировании', 'created_at' => $now],
            ['name' => 'завершен', 'created_at' => $now]
        ]);

        DB::table('labels')->insert([
            ['name' => 'ошибка', 'description' => 'Какая-то ошибка в коде', 'created_at' => $now],
            ['name' => 'документация', 'description' => 'Задача которая касается документации', 'created_at' => $now],
            ['name' => 'дубликат', 'description' => 'Повтор другой задачи', 'created_at' => $now],
            ['name' => 'доработка', 'description' => 'Новая фича', 'created_at' => $now]
        ]);

        Task::factory()->count(20)->create();
    }
}
