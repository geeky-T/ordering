<?php

namespace CronFunctions;


use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class Renting extends Command{
//    public function __construct()
//    {
//        return this.$this->chargeRent();
//    }

    public function run(){
        DB::table('bookings')
            ->join('inventories', 'bookings.hotelId', '=', 'inventories.hotelId')
            ->wheres('bookings.isActive', '=', 1)
            ->update(['bookings.amount' => 'bookings.amount' + 'inventories.rent']);
        return 'Billing Successful';
    }


// php artisan schedule:run 1>> ./logs/scheduler.log 2>&1
}
