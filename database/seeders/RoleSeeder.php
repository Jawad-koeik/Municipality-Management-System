<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['slug' => Role::ADMIN, 'name' => 'رئيس البلدية / مدير النظام'],
            ['slug' => Role::FINANCE_OFFICER, 'name' => 'المسؤول المالي'],
            ['slug' => Role::URBAN_PLANNER, 'name' => 'مهندس / مخطط مدني'],
            ['slug' => Role::HR_MANAGER, 'name' => 'مدير الموارد البشرية'],
            ['slug' => Role::CLERK, 'name' => 'موظف / كاتب'],
            ['slug' => Role::CITIZEN, 'name' => 'مواطن / مقيم'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],
                ['name' => $role['name']]
            );
        }
    }
}
