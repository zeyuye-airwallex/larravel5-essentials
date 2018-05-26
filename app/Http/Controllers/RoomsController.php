<?php

namespace App\Http\Controllers;

use App\Client;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms($client_id, Request $request, Room $room)
    {
        $data = [];
        if ($request -> isMethod('post')) {
            $this->validate(
                $request,
                [
                    'dateFrom' => 'required',
                    'dateTo' => 'required|greater_than_field:dateFrom'
                ]
            );

            $date_in = $request -> input("dateFrom")?: Carbon::today();
            $date_out = $request -> input("dateTo")?: Carbon::today();

            $available_rooms = $room -> getAvailableRooms($date_in, $date_out);

            $data["rooms"] = $available_rooms;
            $data["dateFrom"] = $date_in;
            $data["dateTo"] = $date_out;
            return view('rooms/checkAvailableRooms', $data);
        }

        if ($request -> isMethod('get')) {
            $date_in = Carbon::today();

            $available_rooms = DB::table('rooms as r')
                -> select('r.id', 'r.name')
                -> whereRaw("
                    r.id NOT IN (
                        SELECT room_id FROM reservations 
                        WHERE date_out > '{$date_in}'
                    )")
                -> orderBy('r.id')
                -> get();

            $data["rooms"] = $available_rooms;
            $data["dateFrom"] = $date_in;
            $data["dateTo"] = "";
            return view('rooms/checkAvailableRooms', $data);
        }

    }
}
