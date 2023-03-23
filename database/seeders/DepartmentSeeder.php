<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'id' => '1',
            'name' => '診療部'
        ]);
        Department::create([
            'id' => '2',
            'name' => '看護部'
        ]);
        Department::create([
            'id' => '3',
            'name' => '臨床工学部'
        ]);
    }
}
