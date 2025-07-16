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
                'name' => 'Admin',
                'email' => 'admin@kkn05.com',
                'password' => bcrypt('admin@kkn05.com'),
                'role' => 'admin'
            ],
            [
                'name' => 'Verra Rosyalia Widya Sofyan. S.E., M.M',
                'email' => 'pembimbing@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'pembimbing'
            ],
            [
                'name' => 'Hervian Ervansyah',
                'email' => 'hervian@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'ketua'
            ],
            [
                'name' => 'Fahriza Triputra',
                'email' => 'fahriza@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'wakil'
            ],
            [
                'name' => 'Zalva Mulya Syaripa',
                'email' => 'zalva@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'bendahara'
            ],
            [
                'name' => 'Destiyani',
                'email' => 'destiyani@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'bendahara'
            ],
            [
                'name' => 'Verlita Liston Tirta Bahari',
                'email' => 'verlita@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'sekretaris'
            ],
            [
                'name' => 'Reni Nurhayani',
                'email' => 'reni@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'sekretaris'
            ],
            [
                'name' => 'Teguh Afriansyah',
                'email' => 'teguh@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'sekretaris'
            ],
            [
                'name' => 'Dede Muhammad 
Wallid Arramadlani',
                'email' => 'dede@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Rida Parida Ramdani',
                'email' => 'rida@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Raga Kusnira',
                'email' => 'raga@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Muhamad Ali Akbar Abil Aziz',
                'email' => 'ali@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Eneng Tintin Chosiah',
                'email' => 'eneng@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Muhamad Anshari Lubis',
                'email' => 'anshari@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Rizki Safarudin',
                'email' => 'rizkisafarudin@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Rizki Firdaus',
                'email' => 'rizkifirdaus@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Muhammad Ikbar Barnabas',
                'email' => 'ikbar@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Muhammad Ikhsan Fahrulloh',
                'email' => 'ikhsan@kkn05.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],

        ]);
    }
}
