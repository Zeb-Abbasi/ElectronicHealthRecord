<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            ['email' => 'hafizameer99@gmail.com', 'password' => Hash::make(123456), 'role_id' => 1, 'created_at' => now(),'updated_at' => now()],
            ['email' => 'abbasizeb@gmail.com', 'password' => Hash::make(123456), 'role_id' => 2, 'created_at' => now(),'updated_at' => now()]
        );
    }
}
