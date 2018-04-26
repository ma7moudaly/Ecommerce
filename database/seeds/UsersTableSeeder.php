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
        App\User::create([
            'name'     => 'Mahmoud Aly',
            'email'    => 'mahmoud@mahmoud.com',
            'password' => bcrypt('password')
        ]);
    }
}
