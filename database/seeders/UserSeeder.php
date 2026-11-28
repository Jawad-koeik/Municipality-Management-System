<?php

namespace Database\Seeders;

use App\Models\Citizen;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::pluck('id', 'slug');
        $departments = Department::pluck('id', 'name');
        $password = Hash::make('password');

        $staffUsers = [
            [
                'name' => 'أحمد المدير',
                'email' => 'admin@mms.test',
                'role' => Role::ADMIN,
                'department' => 'الإدارة العامة',
                'position' => 'رئيس البلدية / مدير النظام',
                'salary' => 2500.00,
            ],
            [
                'name' => 'ليلى المحاسبة',
                'email' => 'finance@mms.test',
                'role' => Role::FINANCE_OFFICER,
                'department' => 'الدائرة المالية',
                'position' => 'مسؤول مالي',
                'salary' => 1600.00,
            ],
            [
                'name' => 'كريم المهندس',
                'email' => 'planner@mms.test',
                'role' => Role::URBAN_PLANNER,
                'department' => 'دائرة الهندسة والتنظيم المدني',
                'position' => 'مهندس تنظيم مدني',
                'salary' => 1800.00,
            ],
            [
                'name' => 'سارة الموارد',
                'email' => 'hr@mms.test',
                'role' => Role::HR_MANAGER,
                'department' => 'دائرة الموارد البشرية',
                'position' => 'مدير موارد بشرية',
                'salary' => 1600.00,
            ],
            [
                'name' => 'رامي الموظف',
                'email' => 'clerk@mms.test',
                'role' => Role::CLERK,
                'department' => 'مكتب خدمات المواطنين',
                'position' => 'كاتب خدمات المواطنين',
                'salary' => 1100.00,
            ],
        ];

        foreach ($staffUsers as $staff) {
            $user = User::updateOrCreate(
                ['email' => $staff['email']],
                [
                    'name' => $staff['name'],
                    'role_id' => $roles[$staff['role']],
                    'department_id' => $departments[$staff['department']] ?? null,
                    'password' => $password,
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );

            Employee::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'position' => $staff['position'],
                    'department_id' => $departments[$staff['department']],
                    'hire_date' => '2024-01-15',
                    'salary' => $staff['salary'],
                ]
            );
        }

        $citizens = [
            [
                'name' => 'جواد المواطن',
                'email' => 'citizen@mms.test',
                'national_id' => 'LB-100001',
                'address' => 'بيروت - الحمرا - شارع الرئيسي',
                'contact' => '+961 70 100001',
                'date_of_birth' => '1995-05-10',
            ],
            [
                'name' => 'نور المواطنة',
                'email' => 'citizen2@mms.test',
                'national_id' => 'LB-100002',
                'address' => 'صيدا - الوسط التجاري',
                'contact' => '+961 70 100002',
                'date_of_birth' => '1998-09-22',
            ],
        ];

        foreach ($citizens as $citizenData) {
            $user = User::updateOrCreate(
                ['email' => $citizenData['email']],
                [
                    'name' => $citizenData['name'],
                    'role_id' => $roles[Role::CITIZEN],
                    'department_id' => null,
                    'password' => $password,
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );

            Citizen::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'national_id' => $citizenData['national_id'],
                    'address' => $citizenData['address'],
                    'contact' => $citizenData['contact'],
                    'date_of_birth' => $citizenData['date_of_birth'],
                ]
            );
        }
    }
}
