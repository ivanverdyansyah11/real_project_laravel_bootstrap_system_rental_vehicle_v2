<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'fullname' => 'Customer1',
            'nik' => '9876676587967',
            'phone_number' => '08987654321',
            'identity_card_number' => '98776856767678',
            'family_card_number' => '9878687456454',
            'address' => 'Jl. Monang Maning',
        ]);

        Customer::create([
            'fullname' => 'Customer2',
            'nik' => '89768566757',
            'phone_number' => '97674564565',
            'identity_card_number' => '7856634t3456',
            'family_card_number' => '967545646568',
            'address' => 'Jl. Ahmad Yani',
        ]);

        Customer::create([
            'fullname' => 'Customer3',
            'nik' => '9876676587967',
            'phone_number' => '08987654321',
            'identity_card_number' => '98776856767678',
            'family_card_number' => '9878687456454',
            'address' => 'Jl. Hayam Wuruk',
        ]);

        Customer::create([
            'fullname' => 'Customer4',
            'nik' => '89768566757',
            'phone_number' => '97674564565',
            'identity_card_number' => '7856634t3456',
            'family_card_number' => '967545646568',
            'address' => 'Jl. Renon',
        ]);
    }
}
