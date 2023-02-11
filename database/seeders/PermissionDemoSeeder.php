<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;


class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        /*Permission::create(['name' => 'member store']);
        Permission::create(['name' => 'member edit']);
        Permission::create(['name' => 'member create']);
        Permission::create(['name' => 'delete member']);
        Permission::create(['name' => 'member index']);*/

        Permission::create(['name' => 'booking store']);
        Permission::create(['name' => 'booking edit']);
        Permission::create(['name' => 'booking create']);
        Permission::create(['name' => 'delete booking']);
        Permission::create(['name' => 'booking index']);

        Permission::create(['name' => 'field store']);
        Permission::create(['name' => 'field edit']);
        Permission::create(['name' => 'field create']);
        Permission::create(['name' => 'delete field']);
        Permission::create(['name' => 'field index']);

        Permission::create(['name' => 'user store']);
        Permission::create(['name' => 'user edit']);
        Permission::create(['name' => 'user create']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'user index']);

        //create roles and assign existing permissions
        $viewer = Role::create(['name' => 'viewer']);
        //$viewer->givePermissionTo('member index');
        $viewer->givePermissionTo('booking index');
        $viewer->givePermissionTo('field index');
        $viewer->givePermissionTo('user index');

        $admin = Role::create(['name' => 'admin']);
        //get all permission via Gate:: before rule

        $user = User::findOrfail(1);
        $user->assignRole('admin');

        $user = User::findOrfail(2);
        $user->assignRole('viewer');



    }
}
