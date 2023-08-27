<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;
class CreatePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
               'name'=>'Human resources manager',
            ],
            [
               'name'=>'IT manager',
            ],
            [
               'name'=>'Marketing manager',
            ],
            [
               'name'=>'Product manager',
            ],
            [
               'name'=>'Sales manager',
            ],
        ];

        foreach ($positions as $key => $position) {
            Position::create($position);
        }
    }
}
