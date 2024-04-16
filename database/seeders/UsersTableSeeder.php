<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a sample user
        User::create([
            'name' => 'asma',
            'email' => 'regaiegasma9@gmail.com',
            'password' => Hash::make('password'),
            'usertype' => 'admin', // If you have a 'usertype' column
        ]);

        // You can create more users as needed
    }
}
