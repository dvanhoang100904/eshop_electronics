<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'phone' => '0123456789',
        ]);

        for ($i = 1; $i <= 30; $i++) {
            User::create([
                'name' => 'Customer ' . $i,
                'email' => 'Customer' . $i . '@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 2,
                'phone' => '09876543' . $i,
            ]);
        }
    }
}
