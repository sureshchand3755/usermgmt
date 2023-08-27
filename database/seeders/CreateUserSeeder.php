<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
               'phone_number'=>'8895623652',
               'user_type_id'=> 1,
               'position_id'=>1,
               'department_id'=>1,
               'country_id'=>1,
               'state_id'=>1,
               'password'=> bcrypt('123456'),
            ],

        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
