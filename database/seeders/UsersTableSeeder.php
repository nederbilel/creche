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
            'password' => Hash::make('Klm58f#85vv6e9JG'),
            'usertype' => 'admin', 
        ]);

        // You can create more users as needed
    }
}
