<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Added roles
        DB::table('roles')->insert([
            'role_name' => 'user'
        ]);
        DB::table('roles')->insert([
            'role_name' => 'artist'
        ]);
        DB::table('roles')->insert([
            'role_name' => 'admin'
        ]);

        //Admin
        DB::table('users')->insert([
            'role_id' => 3,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }
}
