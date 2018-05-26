@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="medium-12 large-12 columns">
            <h4>Reservations</h4>
            <table class="stack">
                <thead>
                    <tr>
                        <th width="200">ROOM</th>
                        <th width="200">Name</th>
                        <th width="200">DATES</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $index=>$reservation)
                        <tr>
                            <td>{{ $reservation['room_id'] }}</td>
                            <td>{{ ucfirst($reservation['client'] -> last_name) }}, {{ ucfirst($reservation['client'] -> name) }}</td>
                            <td>{{ $reservation['date_in'] }} => {{ $reservation['date_out'] }}</td>
                            <td>
                                <a class="hollow button" href="{{ route('show_reservation', ["reservation_id" => $reservation['id']]) }}">SHOW</a>
                                <input
                                        class="hollow button alert"
                                        type="submit"
                                        value="DELETE"
                                        onclick="$.ajax({
                                                url: '{{ route('cancel_reservation', ["reservation_id" => $reservation['id']]) }}',
                                                type: 'DELETE',
                                                success: function(res) {
                                                    $(location).attr('href', '{{ route('reservations', [
                                                        "client_id" => request() -> client_id,
                                                        "room_id" => request() -> room_id,
                                                        "date_in" => request() -> date_in,
                                                        "date_out" => request() -> date_out
                                                    ]) }}')
                                                    console.log(res)
                                                },
                                                error: function(err) {
                                                    console.log(err)
                                                }
                                        })"
                                />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection