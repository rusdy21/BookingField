<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        $user = [[


            'name'=> 'gw banget',
            'email'=>'rusdy.begundal@gmail.com',
            'password'=> bcrypt('123456')

        ]];

        foreach($user as $key=>  $value){
        User::create($value);
        }
    }
}
