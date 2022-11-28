<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        //create admin
        $adminRoleId = Role::where('role_slug','admin')->first()->id;

        User::updateOrCreate(
            [
                'role_id'=>$adminRoleId,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), //12345678
                'remember_token' => Str::random(10),
            ]
        );
        User::updateOrCreate(
            [
                'role_id'=>$adminRoleId,
                'name' => 'Admin2',
                'email' => 'admin2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'), //12345
                'remember_token' => Str::random(10),
            ]
        );

        //create user
        $userRoleId = Role::where('role_slug','user')->first()->id;

        User::updateOrCreate(
            [
                'role_id'=>$userRoleId,
                'name' => 'User',
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), //12345678
                'remember_token' => Str::random(10),
            ]
        );
        User::updateOrCreate(
            [
                'role_id'=>$userRoleId,
                'name' => 'User2',
                'email' => 'user2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'), //12345
                'remember_token' => Str::random(10),
            ]
        );

        //create manage
        $managerRoleId = Role::where('role_slug','manager')->first()->id;

        User::updateOrCreate(
            [
                'role_id'=>$managerRoleId,
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'), //12345
                'remember_token' => Str::random(10),
            ]
        );

    }
}
