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
        Permission::create(['name' => 'member store']);
        Permission::create(['name' => 'member edit']);
        Permission::create(['name' => 'member create']);
        Permission::create(['name' => 'delete member']);
        Permission::create(['name' => 'member index']);

        //create roles and assign existing permissions
        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo('member index');

        $admin = Role::create(['name' => 'admin']);
        //get all permission via Gate:: before rule

        $user = User::findOrfail(1);
        $user->assignRole('admin');

        $user = User::findOrfail(2);
        $user->assignRole('viewer');



    }
}
