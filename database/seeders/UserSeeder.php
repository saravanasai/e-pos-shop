<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'saravanasai',
            'email' => 'admin@zerocode.com',
            'password' => Hash::make('1412')
        ]);

        User::create([
            'username' => 'saravana',
            'email' => 'manager@zerocode.com',
            'password' => Hash::make('1412')
        ]);
    }
}
