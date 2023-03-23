<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manufacturer;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manufacturer::create([
            'id' => '1',
            'name' => 'A社',
        ]);
        Manufacturer::create([
            'id' => '2',
            'name' => 'B社',
        ]);
        Manufacturer::create([
            'id' => '3',
            'name' => 'C社',
        ]);
    }
}
