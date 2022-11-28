<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions =Permission::select('id')->get();
        //1. create an admin role
        Role::updateOrCreate([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'role_note'=>'admin had all permissions',
            'is_deleteable' => false,
        ])->permissions()->sync($adminPermissions->pluck('id'));
        //2. and assign all permission on it


        //1. create a user role
        Role::updateOrCreate([
            'role_name' => 'User',
            'role_slug' => 'user',
            'role_note'=>'user had limited permissions',
            'is_deleteable' => true,
        ]);
    }
}
