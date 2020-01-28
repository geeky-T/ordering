<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
session_status();
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
            ->select('B.hotelId','bookingId','name','location','rent','hoursOccupied')
            ->where('userId',$request->session()->get('email'))->get()->toArray();
        //->where('userId',"parth@example.com")->get()->toArray();
      //  print_r($results);
        return $results;//this code takes the user id and shows all the required details that is required displaying
    }
//$request->input('email')
//$request->session()->get('email'
    /**
     * Create booking for user in available hotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$request->session()->put('hotelId', $request->input('hotelId'));

        Log::info($request);
        $check=DB::table('inventories')->where('hotelId',$request->input('hotelId'))->where('isAvailable','=',true)->first();
        if($check)
        {

            DB::table('bookings')->insert(
                [
                    ['userId'=>$request->session()->get('email'),'hotelId'=> $request->input('hotelId'),'hoursOccupied'=>1,'isActive'=>true,'amount'=>250,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
                ]
            );
            $results2=DB::table('inventories')->where('hotelId',$request->input('hotelId'))
                ->update([
                    'isAvailable'=> false
                ]);
            return response('Please book valid hotel',201);
        }
        else
        {
            return response('Please book valid hotel',401);
        }

        //return redirect('http://localhost:8081/booking');

    }
//$request->session()->put('hotelId',
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


        $results= DB::table('inventories')->select('hotelId','name','location','rent')
            ->where('isAvailable','=',true)->get()->toArray();
        //console.log($results);
        return $results;

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
        $results1=DB::table('bookings')->where('userId',$req->session()->get('email'))
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
