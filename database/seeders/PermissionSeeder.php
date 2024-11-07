<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id'    =>  1,
                'name'  =>  'user_management',
                'guard_name' => 'web'
            ],
            [
                'id'    =>  2,
                'name'  =>  'role_management',
                'guard_name' => 'web'
            ],
            [
                'id'    =>  3,
                'name'  =>  'product_management',
                'guard_name' => 'web'
            ],
            [
                'id'    =>  4,
                'name'  =>  'transaction_access',
                'guard_name' => 'web'
            ],
        ];

        Permission::insert($permissions);
    }
}
