<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'fullname' => 'Admin',
            'nik' => '86786565465',
            'phone_number' => '08123456789',
            'address' => 'Jl. Ahmad Yani',
        ]);
    }
}
