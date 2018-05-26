<?php

namespace App\Http\Controllers;

use App\Client;
use App\Reservation;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    // ReservationsController

    public function __construct(Reservation $reservation, Client $client, Room $room)
    {
        $this -> reservation = $reservation;
        $this -> client = $client;
        $this -> room = $room;
    }

    public function index($client_id, $room_id, $date_in, $date_out)
    {
        $client_id = trim($client_id);
        $room_id = trim($room_id);
        $date_in = trim($date_in);
        $date_out = trim($date_out);

        $reservations = $this -> reservation -> all();

        if (! empty($client_id) and $client_id != "all") {
            $reservations = $reservations -> where('client_id', $client_id);
        }

        if (! empty($room_id) and $room_id != "all") {
            $reservations = $reservations -> where('room_id', $room_id);
        }

        if ((! empty($date_in)) and $date_in != "all") {
            if ($date_in == "today") {
                $date_in = Carbon::today();
            }

            $reservations = $reservations -> where('date_in', '>=', $date_in);
        }

        if ((! empty($date_out)) and $date_out != "all") {
            if ($date_out == "today") {
                $date_out = Carbon::today();
            }

            $reservations = $reservations->where('date_out', '<=', $date_out);
        }

        $data = [];
        $data["reservations"] = [];
        foreach ($reservations as $reservation) {
            $data["reservations"][] = [
                "id" => $reservation -> id,
                "room_id" => $reservation -> room_id,
                "client" => $this -> client -> find($reservation -> client_id),
                "date_in" => $reservation -> date_in,
                "date_out" => $reservation -> date_out
            ];
        }

        return view('reservations/index', $data);
    }

    public function book($room_id, Request $request)
    {
        $data = [];

        $this->validate(
            $request,
            [
                'clientID' => 'required',
                'dateFrom' => 'required',
                'dateTo' => 'required|greater_than_field:dateFrom'
            ]
        );

        $client_id = $request -> input('clientID');
        $date_from = $request -> input('dateFrom');
        $date_to = $request -> input('dateTo');

        $data["date_in"] = new \DateTime($date_from);
        $data["date_out"] = new \DateTime($date_to);
        $data["client_id"] = $client_id;
        $data["room_id"] = $room_id;

        if ($date_from < $date_to) {
            $this -> reservation -> insert($data);
            return redirect() -> route('reservations', [
                "client_id" => $client_id,
                "room_id" => $room_id,
                "date_in" => "all",
                "date_out" => "all"
            ]);
        }

        return redirect() -> route('check_room', ["client_id" => $client_id]);

    }

    public function show($reservation_id)
    {
        $data["reservation"] = $this -> reservation -> find($reservation_id);
        $data["reservation"]["client"] = $this->client->find($data["reservation"] -> client_id);
        $data["reservation"]["room"] = $this->room->find($data["reservation"] -> room_id);
        return view('reservations/show', $data);
    }

    public function cancel($reservation_id)
    {
        $reservation = $this->reservation->find($reservation_id);
        $reservation -> delete();
        return $reservation;
    }
}
