<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserOrderController extends Controller
{
    /**
     * Display the booked hotels by perticular user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results= DB::table('bookings as B')
            ->join('inventories as I', 'B.hotelId', '=', 'I.hotelId')
            ->select('bookingId','name','amount','location','rent','hoursOccupied')
            ->where('userId',$request->input('userId'))->get()->toArray();
        //console.log($results);
        return $results;//this code takes the user id and shows all the required details that is required displaying
    }
//$request->input('email')
    /**
     * Create booking for user in available hotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        DB::table('bookings')->insert(
            [
                ['userId'=>$req->input('userId'),'hotelId'=>$req->input('hotelId'),'hoursOccupied'=>1,'isActive'=>true,'amount'=>250,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
            ]
        );
        $results2=DB::table('inventories')->where('hotelId',$req->input('hotelId'))
            ->update([
                'isAvailable'=> false
            ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //

    }

    /**
     * Display the available hotels.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function available()
    {


        $results= DB::table('inventories')->select('name','location','rent')
            ->where('isAvailable','=',true)->get();
        //console.log($results);
        return response()->json([$results]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function end(Request $req)
    {
        //
        $results1=DB::table('bookings')->where('userId',$req->input('userId'))
            ->where('hotelId',$req->input('hotelId'))
            ->update([
                'isActive'=> 0
            ]);

        $results2=DB::table('inventories')->where('hotelId',$req->input('hotelId'))
            ->update([
                'isAvailable'=> true
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
