<?php

use Illuminate\Database\Seeder;

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
            'name' => 'Dwi Aji Kurniawan',
            'email' => 'dwi.aji.kurniawan@gmail.com',
            'password' => '$2y$10$ttMe.ybfZXhnaGcR1e529uLyGF0yTlwZ4ClbctX/N.3xNe/o5n44W',
            'created_at' => '2016-04-08 07:50:50',
            'updated_at' => '2016-04-08 08:12:21'
        ]);
    }
}
