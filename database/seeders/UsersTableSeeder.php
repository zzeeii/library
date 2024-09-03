<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { $user=
        [
             'name'=>'zein',
             'email'=>'z@gmail.com',
             'password'=>'123456',
             'role'=>'admin'
        ];
        User::create($user);
    }
}
