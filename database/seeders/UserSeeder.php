<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('users')->where('email', 'superadmin@warungacehbangari.com')->first()) {
            DB::table('users')->insert([
                'company_id' => 1,
                'role_id' => 1,
                'name' => 'superadmin',
                'email' => 'superadmin@warungacehbangari.com',
                'password' => '$2y$10$RjXfjQq5DJH3ZeZZwDIIjuJFDqQZU1hEu0WQh9iILfXng5C.R8Xn2',
                'is_superadmin' => 1,
                'created_at' => now(),
                'is_active' => 1
            ]);
        }
    }
}
