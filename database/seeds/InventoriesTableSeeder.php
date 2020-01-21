<?php

use Illuminate\Database\Seeder;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(\Illuminate\Support\Facades\Schema::hasTable('inventories') == false)
            \Illuminate\Support\Facades\DB::delete('inventories');
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; ++$i){
            \App\Inventory::Create([
                'name' => $faker->name,
                'location' => $faker->city,
                'rent' => $faker->randomNumber(2),
                'isAvailable' => (int)$faker->boolean,
            ]);
        }
    }
}
