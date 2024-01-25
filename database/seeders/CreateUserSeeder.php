<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user =  [
        [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'is_admin' => '1',
            'password' => bcrypt('123456789')
        ],
        [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'is_admin' => '0',
            'password' => bcrypt('123456789'),
        ]
        ];
        foreach($user as $key => $value) {
            User::create($value);
        }
    }
}
