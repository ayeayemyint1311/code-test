<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Aye Aye Myint',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('adminpass')
            ],
            [
                'id' => 2,
                'name' => 'Thwe Thwe Win',
                'email' => 'thwe@gmail.com',
                'password' => Hash::make('adminpass')
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
