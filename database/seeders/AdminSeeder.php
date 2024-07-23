<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $adminRole = Role::where('name', 'admin')->first();
        $ownerRole = Role::where('name', 'owner')->first();

        if (!$adminRole || !$ownerRole) {
            $this->command->info('Roles not found. Please run the RoleSeeder first.');
            return;
        }
        
        $admin = User::create([

            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin@123',
            'phone'=> '9999009898',
            'role_id' => $adminRole->id,
        ]);

        $owner = User::create([
             'id' =>'2', 
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => 'owner@123',
            'phone'=> '9898009898',
            'role_id' => $ownerRole->id,

        ]);

        $adminRole = Role::findByName('admin');
        $ownerRole = Role::findByName('owner');

        $admin->assignRole($adminRole);
        $owner->assignRole($ownerRole);
    }
    
}

