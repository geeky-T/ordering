<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class chargeRent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourly:chargeRent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charges Rent';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::update('update inventories, bookings set bookings.amount = bookings.amount + inventories.rent, bookings.hoursOccupied = bookings.hoursOccupied + 1  where inventories.hotelId = bookings.hotelId AND bookings.isActive = 1');
    }
}
