<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'gender' => 'male',
                'date_of_birth' => '1999-01-01',
            ],
            [
                'name' => 'user1',
                'email' => 'z123048@shibaura-it.ac.jp',
                'password' => bcrypt('user'),
                'gender' => 'male',
                'glc_verified' => true,
                'date_of_birth' => '1999-01-01',
            ],
            [
                'name' => 'user2',
                'email' => 'z123047@shibaura-it.ac.jp',
                'password' => bcrypt('user'),
                'gender' => 'female',
                'date_of_birth' => '1999-01-01',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
