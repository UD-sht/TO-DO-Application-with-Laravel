<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'user_code' => '1111',
                'email_address' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'password_change_date' => date('Y-m-d H:i:s'),
                'activated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        DB::table('sec_users')->insert($users);
    }
}
