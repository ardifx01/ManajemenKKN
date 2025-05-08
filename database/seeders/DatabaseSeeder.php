<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            [
                'nama_user' => 'Administrator',
                'email' => 'administrator@gmail.com',
                'password' => bcrypt('password'),
                'telepon'  => '08123456789',
                'role' => 'administrator'
            ],
            [
                'nama_user' => 'Operator',
                'email' => 'operator@gmail.com',
                'password' => bcrypt('password'),
                'telepon'  => '08123456789',
                'role' => 'operator'
            ]
        ]);
    }
}
