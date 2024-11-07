<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id'    =>  1,
                'name'  =>  'Admin',
                'guard_name' => 'web'
            ],
            [
                'id'    =>  2,
                'name'  =>  'User',
                'guard_name' => 'web'
            ],
        ];

        Role::insert($roles);
    }
}
