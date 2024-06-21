<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'admins_id' => 1,
        ]);

        User::create([
            'name' => 'Customer1',
            'email' => 'customer1@gmail.com',
            'password' => 'Customer1',
            'customers_id' => 1,
        ]);

        User::create([
            'name' => 'Customer2',
            'email' => 'customer2@gmail.com',
            'password' => 'Customer2',
            'customers_id' => 1,
        ]);

        User::create([
            'name' => 'Customer3',
            'email' => 'customer3@gmail.com',
            'password' => 'Customer3',
            'customers_id' => 1,
        ]);

        User::create([
            'name' => 'Customer4',
            'email' => 'customer4@gmail.com',
            'password' => 'Customer4',
            'customers_id' => 1,
        ]);

        User::create([
            'name' => 'Driver1',
            'email' => 'driver1@gmail.com',
            'password' => 'Driver1',
            'drivers_id' => 1,
        ]);

        User::create([
            'name' => 'Driver2',
            'email' => 'driver2@gmail.com',
            'password' => 'Driver2',
            'drivers_id' => 1,
        ]);

        User::create([
            'name' => 'Driver3',
            'email' => 'driver3@gmail.com',
            'password' => 'Driver3',
            'drivers_id' => 1,
        ]);

        User::create([
            'name' => 'Driver4',
            'email' => 'driver4@gmail.com',
            'password' => 'Driver4',
            'drivers_id' => 1,
        ]);
    }
}
