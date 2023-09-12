<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            [
                'username' => 'admin',
                'password' => bcrypt('Somdet2703'),
                'name' => 'Administrator',
                'deptId' => 1,
                'isAdmin' => '1',
                'enable' => '1'
            ],
            [
                'username' => 'user',
                'password' => bcrypt('1234'),
                'name' => 'User Demo',
                'deptId' => 1,
                'isAdmin' => '0',
                'enable' => '1'
            ]
        ];

        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
