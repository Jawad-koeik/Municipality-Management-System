<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'الإدارة العامة', 'branch' => 'المبنى الرئيسي'],
            ['name' => 'الدائرة المالية', 'branch' => 'المبنى الرئيسي'],
            ['name' => 'دائرة الهندسة والتنظيم المدني', 'branch' => 'المبنى الرئيسي'],
            ['name' => 'دائرة الموارد البشرية', 'branch' => 'المبنى الرئيسي'],
            ['name' => 'مكتب خدمات المواطنين', 'branch' => 'مركز خدمة الجمهور'],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(
                ['name' => $department['name']],
                ['branch' => $department['branch']]
            );
        }
    }
}
