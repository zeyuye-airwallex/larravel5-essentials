@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="medium-12 large-12 columns">
            <h4>Clients/Booking</h4>
            <div class="medium-2  columns">BOOKING FOR:</div>
            <div class="medium-2  columns"><b>Mr. Roy Adams</b></div>
            <form action="{{ route("check_room", ["client_id" => request()-> client_id]) }}" method="post">
                <div class="medium-1  columns">FROM:</div>
                <div class="medium-2  columns"><input name="dateFrom" value="{{ old('dateFrom')?: ($dateFrom) }}" type="text" class="datepicker" /></div>
                <small class="error">{{ $errors -> first('dateFrom') }}</small>
                <div class="medium-1  columns">TO:</div>
                <div class="medium-2  columns"><input name="dateTo" value="{{ old('dateTo')?: ($dateTo ?: "") }}" type="text" class="datepicker" /></div>
                <small class="error">{{ $errors -> first('dateTo') }}</small>
                <div class="medium-2  columns"><input class="button" type="submit" value="SEARCH" /></div>
            </form>

            <table class="stack">
                <thead>
                <tr>
                    <th width="200">Room</th>
                    <th width="200">Availability</th>
                    <th width="200">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($rooms as $index=>$room)
                    <tr>
                        <td>{{ $room -> name }}</td>
                        <td>
                            <div class="callout success">
                                <h7>Available</h7>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route("book", ["room_id" => $room -> id]) }}" method="post">
                                <input type="hidden" name="dateTo" value="{{ old('dateTo')?: ($dateTo?: "") }}" />
                                <small class="error">{{ $errors -> first('dateTo') }}</small>
                                <input type="hidden" name="dateFrom" value="{{ $dateFrom }}" />
                                <small class="error">{{ $errors -> first('dateFrom') }}</small>
                                <input type="hidden" name="clientID" value="{{ request() -> client_id }}"/>
                                <input class="hollow button warning" type="submit" value="BOOK ROOM"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection