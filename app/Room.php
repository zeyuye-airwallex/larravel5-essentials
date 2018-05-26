<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    //
    public function getAvailableRooms($start, $end) {
        $rooms = DB::table('rooms as r')
            -> select('r.id', 'r.name')
            -> whereRaw("
                r.id NOT IN(
                    SELECT b.room_id FROM reservations b
                    WHERE (
                        b.date_in < '{$end}' AND
                        b.date_out > '{$start}'
                    )
                )
            ")
            -> orderBy('r.id')
            -> get();

        return $rooms;
    }
}
