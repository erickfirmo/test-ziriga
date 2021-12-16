<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'Érick Firmo',
            'email' => 'erickfirmo1996@gmail.com',
            'password' => bcrypt('password'),
            'dob' => '18/08/1996',
        ]);

        DB::table('customers')->insert([
            'name' => 'Zíriga User',
            'email' => 'ziriga.user@gmail.com',
            'password' => bcrypt('password'),
            'dob' => '01/01/1985',
        ]);

        \App\Models\Customer::factory(100)->create();
    }
}
