<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $permissions = [
            ['name' => 'users', 'guard_name' => 'api'],
            ['name' => 'employees', 'guard_name' => 'api'],
            ['name' => 'projects', 'guard_name' => 'api'],
            ['name' => 'technologies', 'guard_name' => 'api'],
            ['name' => 'client', 'guard_name' => 'api'],
            ['name' => 'employement', 'guard_name' => 'api'],
            ['name' => 'attendance', 'guard_name' => 'api'],
            ['name' => 'salaries', 'guard_name' => 'api'],
            ['name' => 'leave', 'guard_name' => 'api'],
            ['name' => 'training', 'guard_name' => 'api'],
            ['name' => 'interview', 'guard_name' => 'api'],
            ['name' => 'expences', 'guard_name' => 'api'],
            ['name' => 'notification', 'guard_name' => 'api'],
            ['name' => 'role', 'guard_name' => 'api'],
            ['name' => 'completed_training', 'guard_name' => 'api'],
            ['name' => 'employee_status', 'guard_name' => 'api'],
            ['name' => 'training_topic', 'guard_name' => 'api'],
        ];

        // $OwnerPermissions =[
        //     ['name' => 'interview', 'guard_name' => 'api'],
        //     ['name' => 'expences', 'guard_name' => 'api'],
        //     ['name' => 'notification', 'guard_name' => 'api'],
        //     ['name' => 'role', 'guard_name' => 'api'],
        //     ['name' => 'completed_training', 'guard_name' => 'api'],
        //     ['name' => 'employee_status', 'guard_name' => 'api'],
        //     ['name' => 'training_topic', 'guard_name' => 'api'],
        // ];

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'api']);

        $ownerRole = Role::create(['name' => 'owner']);


        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'guard_name' => $permission['guard_name'],
            ]);
            $adminRole->givePermissionTo($permission['name']);
        }

        $ownerRole->givePermissionTo($permission['name']);
    }
}
