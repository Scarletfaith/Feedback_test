<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Test Manager',
                'role' => 'manager',
                'email' => 'test_manager@mail.com',
                'password' => '$2y$10$VT7F99Htk1m9tqhEPMMtLe3W1xwQmZGWVWn5pIPxuWHmAa5A7SDWS',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('users')->insert($users);
    }
}
