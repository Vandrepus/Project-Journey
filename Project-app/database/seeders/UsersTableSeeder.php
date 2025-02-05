<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'surname' => 'Administrator', 
            'username' => 'admin',
            'email' => 'admin@example.com',
            'usertype' => 'admin',
            'password' => Hash::make('password'),
        ]);
        

        // Create Regular Users
        User::factory(10)->create(); 
    }
}
