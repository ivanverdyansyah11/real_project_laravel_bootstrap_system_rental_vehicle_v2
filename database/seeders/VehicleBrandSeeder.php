<?php

namespace Database\Seeders;

use App\Models\VehicleBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleBrand::create([
            'name' => 'Toyota',
        ]);

        VehicleBrand::create([
            'name' => 'Honda',
        ]);

        VehicleBrand::create([
            'name' => 'Suzuki',
        ]);
    }
}
