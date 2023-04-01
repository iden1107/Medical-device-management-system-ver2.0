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
            'name' => '医療 太郎',
            'kana' => 'イリョウ タロウ',
            'department_id' => '1',
            'employment_date' => '2022-04-01',
            'password' => bcrypt('1111')
        ]);
        User::create([
            'id' => '2',
            'name' => '医療 花子',
            'kana' => 'イリョウ ハナコ',
            'department_id' => '2',
            'employment_date' => '2022-04-01',
            'password' => bcrypt('2222')
        ]);
        User::create([
            'id' => '3',
            'name' => '医療 二郎',
            'kana' => 'イリョウ ジロウ',
            'department_id' => '3',
            'employment_date' => '2022-04-01',
            'password' => bcrypt('3333')
        ]);
        User::create([
            'id' => '9999',
            'name' => '管理者',
            'kana' => 'カンリシャ',
            'department_id' => '1',
            'employment_date' => '2022-04-01',
            'password' => bcrypt('9999'),
            'permission' => '1'
        ]);
    }
}
