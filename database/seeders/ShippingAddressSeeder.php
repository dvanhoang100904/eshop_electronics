<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\ShippingAddress;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();

        foreach ($users as $user) {

            ShippingAddress::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'user_id' => $user->user_id,
            ]);
        }
    }
}
