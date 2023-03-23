<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create([
            'id' => '1',
            'name' => '臨床工学室',
        ]);
        Location::create([
            'id' => '2',
            'name' => '整形外科',
        ]);
        Location::create([
            'id' => '3',
            'name' => '眼科',
        ]);
        Location::create([
            'id' => '4',
            'name' => '内視鏡センター',
        ]);
        Location::create([
            'id' => '5',
            'name' => '生理検査室',
        ]);
        Location::create([
            'id' => '6',
            'name' => '皮膚科',
        ]);
        Location::create([
            'id' => '7',
            'name' => '産婦人科',
        ]);
        Location::create([
            'id' => '8',
            'name' => 'リハビリテーション室',
        ]);
        Location::create([
            'id' => '9',
            'name' => '外科',
        ]);
        Location::create([
            'id' => '10',
            'name' => '処置室',
        ]);
        Location::create([
            'id' => '11',
            'name' => '内科',
        ]);
        Location::create([
            'id' => '12',
            'name' => '泌尿器科',
        ]);
        Location::create([
            'id' => '13',
            'name' => '小児科',
        ]);
    }
}
