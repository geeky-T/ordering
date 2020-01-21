<?php

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private function stdObjectToArray($arrayOfObject){
        return array_map(function ($value) {
            return (array)$value;
        }, $arrayOfObject);
    }

    public function run()
    {
        if(\Illuminate\Support\Facades\Schema::hasTable('bookings') == false)
            \Illuminate\Support\Facades\DB::delete('bookings');

        $faker = \Faker\Factory::create();

        // adds active bookings to the database
        $hotels = \Illuminate\Support\Facades\DB::table('inventories')
            ->select('hotelId', 'rent', 'isAvailable')
            ->where('isAvailable', '=', 0)
            ->get()
            ->toArray();
        $users = \App\User::all()
            ->pluck('email')
            ->toArray();
        $hotels = $this->stdObjectToArray($hotels);

        $bookings = [];
        while(count($hotels)){
            $hotel = array_pop($hotels);
            $hours = $faker->randomNumber();
            array_push($bookings, [
                'userId' => $faker->randomElement($users),
                'hotelId' => $hotel['hotelId'],
                'hoursOccupied' => $hours,
                'amount' => $hours*$hotel['rent'],
                'isActive' => 1,
            ]);
        }

        // adds past bookings to the database
        $hotels = \Illuminate\Support\Facades\DB::table('inventories')
            ->select('hotelId', 'rent', 'isAvailable')
            ->inRandomOrder()
            ->get(10)
            ->toArray();
        $hotels = $this->stdObjectToArray($hotels);
        while(count($hotels) > 0){
            $hotel = array_pop($hotels);
            $hours = $faker->randomNumber();
            array_push($bookings, [
                'userId' => $faker->randomElement($users),
                'hotelId' => $hotel['hotelId'],
                'hoursOccupied' => $hours,
                'amount' => $hours*$hotel['rent'],
                'isActive' => 0,
            ]);
        }

        while(count($bookings) > 0){
            \App\Booking::Create(array_pop($bookings));
        }
    }
}
