<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database se;ds.
     */
    public function run(): void
    {
        Setting::create([
            'id' => '1',
            'setting_minutes' => '10.0'
        ]);
    }
}
