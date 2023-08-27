<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
class CreateDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
               'name'=>'Human Resources',
            ],
            [
               'name'=>'Product Management ',
            ],
            [
               'name'=>'Quality Assurance',
            ],
            [
               'name'=>'Sales',
            ],
            [
               'name'=>'Marketing',
            ],
        ];

        foreach ($departments as $key => $department) {
            Department::create($department);
        }
    }
}
