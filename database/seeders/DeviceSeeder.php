<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Device::create([
            'id' => '1',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '3',
            'inspection_date' => '2023-06-01',
            'location_id' => '1',
        ]);
        Device::create([
            'id' => '2',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '1',
            'inspection_date' => '2023-06-01',
            'location_id' => '1',
        ]);
        Device::create([
            'id' => '3',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '0',
            'inspection_date' => '2023-03-01',
            'location_id' => '2',
        ]);
        Device::create([
            'id' => '4',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '1',
            'inspection_date' => '2023-06-01',
            'location_id' => '1',
        ]);
        Device::create([
            'id' => '5',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '0',
            'inspection_date' => '2023-06-01',
            'location_id' => '1',
        ]);
        Device::create([
            'id' => '6',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '0',
            'inspection_date' => '2023-05-01',
            'location_id' => '11',
        ]);
        Device::create([
            'id' => '7',
            'name' => '心電図モニター',
            'manufacturer_id' => '1',
            'status' => '2',
            'inspection_date' => '2023-06-01',
            'location_id' => '9',
        ]);
        Device::create([
            'id' => '8',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '3',
            'inspection_date' => '2023-02-01',
            'location_id' => '4',
        ]);
        Device::create([
            'id' => '9',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '0',
            'inspection_date' => '2023-06-01',
            'location_id' => '7',
        ]);
        Device::create([
            'id' => '10',
            'name' => '心電図モニター',
            'manufacturer_id' => '1',
            'status' => '4',
            'inspection_date' => '2023-06-01',
            'location_id' => '99',
        ]);
        Device::create([
            'id' => '11',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '1',
            'inspection_date' => '2023-06-01',
            'location_id' => '8',
        ]);
        Device::create([
            'id' => '12',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '0',
            'inspection_date' => '2023-06-01',
            'location_id' => '8',
        ]);
        Device::create([
            'id' => '13',
            'name' => '心電図モニター',
            'manufacturer_id' => '1',
            'status' => '1',
            'inspection_date' => '2023-06-01',
            'location_id' => '10',
        ]);
        Device::create([
            'id' => '14',
            'name' => '心電図モニター',
            'manufacturer_id' => '1',
            'status' => '0',
            'inspection_date' => '2023-06-01',
            'location_id' => '4',
        ]);
        Device::create([
            'id' => '15',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '3',
            'inspection_date' => '2023-06-01',
            'location_id' => '1',
        ]);
        Device::create([
            'id' => '16',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '1',
            'inspection_date' => '2023-06-01',
            'location_id' => '1',
        ]);
        Device::create([
            'id' => '17',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '2',
            'inspection_date' => '2023-06-01',
            'location_id' => '1',
        ]);
        Device::create([
            'id' => '18',
            'name' => '心電図モニター',
            'manufacturer_id' => '1',
            'status' => '1',
            'inspection_date' => '2023-06-01',
            'location_id' => '7',
        ]);
        Device::create([
            'id' => '19',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '0',
            'inspection_date' => '2023-06-01',
            'location_id' => '1',
        ]);
        Device::create([
            'id' => '20',
            'name' => '点滴ポンプ',
            'manufacturer_id' => '1',
            'status' => '0',
            'inspection_date' => '2023-06-01',
            'location_id' => '6',
        ]);
    }
}
