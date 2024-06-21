<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'vehicle_series_id' => 1,
            'name' => 'Toyota Supra',
            'stnk_name' => 'Tenant1',
            'license_plate_number' => 'B 3452 IU',
            'kilometer' => 12,
            'capacity' => 4,
            'price' => 300000,
            'year_of_creation' => '2010',
            'date_purchased' => '2012-03-10',
            'color' => 'gray',
            'frame_number' => 'BTERH56Y54Y6',
            'machine_number' => 'K67I67UTY56',
            'status' => 1,
        ]);

        Vehicle::create([
            'vehicle_series_id' => 2,
            'name' => 'Toyota Honda',
            'stnk_name' => 'Tenant2',
            'license_plate_number' => 'L 6453 IU',
            'kilometer' => 7,
            'capacity' => 6,
            'price' => 200000,
            'year_of_creation' => '2012',
            'date_purchased' => '2016-02-08',
            'color' => 'red',
            'frame_number' => 'Y56YTJ67I67',
            'machine_number' => 'K789I67867',
            'status' => 1,
        ]);

        Vehicle::create([
            'vehicle_series_id' => 3,
            'name' => 'Avanza',
            'stnk_name' => 'Tenant3',
            'license_plate_number' => 'L 7564 UX',
            'kilometer' => 9,
            'capacity' => 6,
            'price' => 100000,
            'year_of_creation' => '2018',
            'date_purchased' => '2020-07-20',
            'color' => 'gray',
            'frame_number' => 'BTYHY566Y54Y56',
            'machine_number' => '7889O8K988',
            'status' => 1,
        ]);

        Vehicle::create([
            'vehicle_series_id' => 2,
            'name' => 'Cruz',
            'stnk_name' => 'Tenant4',
            'license_plate_number' => 'AB 7856 WQ',
            'kilometer' => 24,
            'capacity' => 5,
            'price' => 150000,
            'year_of_creation' => '2020',
            'date_purchased' => '2022-08-28',
            'color' => 'yellow',
            'frame_number' => 'HTYGHT56Y6556',
            'machine_number' => 'KLIUI87I78',
            'status' => 1,
        ]);
    }
}
