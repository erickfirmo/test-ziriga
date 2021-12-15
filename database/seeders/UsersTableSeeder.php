<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Érick Firmo',
            'email' => 'erickfirmo1996@gmail.com',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Ziriga User',
            'email' => 'ziriga.user@gmail.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory(100)->create();
    }
}
