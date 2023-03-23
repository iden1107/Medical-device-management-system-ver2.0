<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '1',
            'name' => '日本 太郎',
            'kana' => 'ニホン タロウ',
            'department_id' => '1',
            'employment_date' => '2022-04-01',
            'password' => bcrypt('1111')
        ]);
        User::create([
            'id' => '2',
            'name' => '日本 花子',
            'kana' => 'ニホン ハナコ',
            'department_id' => '2',
            'employment_date' => '2022-04-01',
            'password' => bcrypt('2222')
        ]);
        User::create([
            'id' => '3',
            'name' => '日本 二郎',
            'kana' => 'ニホン ジロウ',
            'department_id' => '1',
            'employment_date' => '2022-04-01',
            'password' => bcrypt('3333')
        ]);
    }
}
