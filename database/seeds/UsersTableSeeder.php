<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456'),
                'is_admin' => 1,
                'logo_number' => 1,
            ],
            [
                'name' => 'Member',
                'email' => 'member@example.com',
                'password' => Hash::make('123456'),
                'is_admin' => 0,
                'logo_number' => 2,
            ]
        ]);
    }
}
