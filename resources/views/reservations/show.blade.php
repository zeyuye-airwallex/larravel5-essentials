@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="medium-12 large-12 columns">
            <h4>Show Reservation</h4>
            <div>
                <table>
                    <tr>
                        <td>Room ID</td>
                        <td><a href="{{ route('reservations', [
                            "client_id" => "all",
                            "room_id" => $reservation['room_id'],
                            "date_in" => "all",
                            "date_out" => "all"
                        ]) }}">{{ $reservation['room'] -> name }}</a></td>
                    </tr>
                    <tr>
                        <td>Client Name</td>
                        <td><a href="{{ route('show_client', ["client_id" => $reservation['client_id']]) }}">{{ ucfirst($reservation['client'] -> last_name) }}, {{ ucfirst($reservation['client'] -> name) }}</a></td>
                    </tr>
                    <tr>
                        <td>Date In</td>
                        <td>{{ $reservation['date_in'] }}</td>
                    </tr>
                    <tr>
                        <td>Date To</td>
                        <td>{{ $reservation['date_out'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection