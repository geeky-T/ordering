<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(\Illuminate\Support\Facades\Schema::hasTable('users') == false)
            \Illuminate\Support\Facades\DB::delete('users');

        $faker = \Faker\Factory::create();
        $password = \Illuminate\Support\Facades\Hash::make('order');

        for ($i = 0; $i < 10; ++$i){
            \App\User::Create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $password
            ]);
        }
    }
}
