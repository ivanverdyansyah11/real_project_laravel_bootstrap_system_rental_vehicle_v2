<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::create([
            'fullname' => 'Driver1',
            'nik' => '9876676587967',
            'phone_number' => '08987654321',
            'identity_card_number' => '98776856767678',
            'drivers_license_number' => '9878687456454',
            'address' => 'Jl. Monang Maning',
            'status' => 1,
        ]);

        Driver::create([
            'fullname' => 'Driver2',
            'nik' => '86775657645',
            'phone_number' => '093453445756',
            'identity_card_number' => '345456576',
            'drivers_license_number' => '756756768',
            'address' => 'Jl. Nusa Dua',
            'status' => 1,
        ]);

        Driver::create([
            'fullname' => 'Driver3',
            'nik' => '8675445464',
            'phone_number' => '234346567',
            'identity_card_number' => '4568677345657',
            'drivers_license_number' => '34565675685635',
            'address' => 'Jl. Tukad Bengah',
            'status' => 1,
        ]);

        Driver::create([
            'fullname' => 'Driver4',
            'nik' => '09854346547',
            'phone_number' => '098956754645',
            'identity_card_number' => '3453454756',
            'drivers_license_number' => '34547567456756',
            'address' => 'Jl. Tukad Barito',
            'status' => 1,
        ]);
    }
}
