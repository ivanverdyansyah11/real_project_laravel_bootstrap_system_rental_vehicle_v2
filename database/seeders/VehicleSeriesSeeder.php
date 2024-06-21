<?php

namespace Database\Seeders;

use App\Models\VehicleSeries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleSeries::create([
            'vehicle_brands_id' => 1,
            'serial_number' => '86774565756345',
        ]);

        VehicleSeries::create([
            'vehicle_brands_id' => 2,
            'serial_number' => 'HT5U65U56Y56',
        ]);

        VehicleSeries::create([
            'vehicle_brands_id' => 3,
            'serial_number' => 'GRTY56U6Y34T45T',
        ]);
    }
}
