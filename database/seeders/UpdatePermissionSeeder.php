<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UpdatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         app()[PermissionRegistrar::class]->forgetCachedPermissions();

         $viewer = Role::where('name','viewer')->firstOrFail();
        $viewer->givePermissionTo('booking index');
        $viewer->givePermissionTo('field index');
        $viewer->givePermissionTo('user index');


    }
}
