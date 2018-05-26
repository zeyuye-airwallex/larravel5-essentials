@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="medium-12 large-12 columns">
            <h4>{{ ucfirst($action) }} Client</h4>
            @switch($action)
                @case('new')
                    <form action="{{ route('create_client') }}" method="post">
                        <div class="medium-4  columns">
                            <label>Title</label>
                            <select name="title">
                                @foreach ($titles as $index=>$title)
                                    <option value="{{ strtolower($title) }}" {{ $index == 0 ? "selected" : "" }}>{{ $title }}.</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="medium-4  columns">
                            <label>Name</label>
                            <input name="name" type="text" value="{{ old('name') }}">
                            <small class="error">{{ $errors -> first('name') }}</small>
                        </div>
                        <div class="medium-4  columns">
                            <label>Last Name</label>
                            <input name="last_name" type="text" value="{{ old('last_name') }}">
                            <small class="error">{{ $errors -> first('last_name') }}</small>
                        </div>
                        <div class="medium-8  columns">
                            <label>Address</label>
                            <input name="address" type="text" value="{{ old('address') }}">
                            <small class="error">{{ $errors -> first('address') }}</small>
                        </div>
                        <div class="medium-4  columns">
                            <label>zip_code</label>
                            <input name="zip_code" type="text" value="{{ old('zip_code') }}">
                            <small class="error">{{ $errors -> first('zip_code') }}</small>
                        </div>
                        <div class="medium-4  columns">
                            <label>City</label>
                            <input name="city" type="text" value="{{ old('city') }}">
                            <small class="error">{{ $errors -> first('city') }}</small>
                        </div>
                        <div class="medium-4  columns">
                            <label>State</label>
                            <input name="state" type="text" value="{{ old('state') }}">
                            <small class="error">{{ $errors -> first('state') }}</small>
                        </div>
                        <div class="medium-12  columns">
                            <label>Email</label>
                            <input name="email" type="text" value="{{ old('email') }}">
                            <small class="error">{{ $errors -> first('email') }}</small>
                        </div>
                        <div class="medium-12  columns">
                            <input value="SAVE" class="button success hollow" type="submit">
                        </div>
                    </form>
                    @break
                @case('edit')
                    <form action="{{ route('update_client', [ 'client_id' => $client['id'] ]) }}" method="post">
                        <div class="medium-4  columns">
                            <label>Title</label>
                            <select name="title">
                                @foreach ($titles as $index=>$title)
                                    <option value="{{ strtolower($title) }}" {{ strtolower($title) == $client['title'] ? "selected" : "" }}>{{ $title }}.</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="medium-4  columns">
                            <label>Name</label>
                            <input name="name" type="text" value="{{ old('name') ?: $client['name'] }}">
                            <small class="error">{{ $errors -> first('name') }}</small>
                        </div>
                        <div class="medium-4  columns">
                            <label>Last Name</label>
                            <input name="last_name" type="text" value="{{ old('last_name') ?: $client['last_name'] }}">
                            <small class="error">{{ $errors -> first('last_name') }}</small>
                        </div>
                        <div class="medium-8  columns">
                            <label>Address</label>
                            <input name="address" type="text" value="{{ old('address') ?: $client['address'] }}">
                            <small class="error">{{ $errors -> first('address') }}</small>
                        </div>
                        <div class="medium-4  columns">
                            <label>zip_code</label>
                            <input name="zip_code" type="text" value="{{ old('zip_code') ?: $client['zip_code'] }}">
                            <small class="error">{{ $errors -> first('zip_code') }}</small>
                        </div>
                        <div class="medium-4  columns">
                            <label>City</label>
                            <input name="city" type="text" value="{{ old('city') ?: $client['city'] }}">
                            <small class="error">{{ $errors -> first('city') }}</small>
                        </div>
                        <div class="medium-4  columns">
                            <label>State</label>
                            <input name="state" type="text" value="{{ old('state') ?: $client['state']}}">
                            <small class="error">{{ $errors -> first('state') }}</small>
                        </div>
                        <div class="medium-12  columns">
                            <label>Email</label>
                            <input name="email" type="text" value="{{ old('email') ?: $client['email'] }}">
                            <small class="error">{{ $errors -> first('email') }}</small>
                        </div>
                        <div class="medium-12  columns">
                            <input value="UPDATE" class="button success hollow" type="submit">
                        </div>
                    </form>
                    @break
                @default
                <div>
                    <table>
                        <tr>
                            <td>Title</td>
                            <td>{{ ucfirst($client['title']) }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $client['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td>{{ $client['last_name'] }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $client['address'] }}</td>
                        </tr>
                        <tr>
                            <td>Zip Code</td>
                            <td>{{ $client['zip_code'] }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ $client['city'] }}</td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>{{ $client['state'] }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $client['email'] }}</td>
                        </tr>
                    </table>
                </div>
            @endswitch
        </div>
    </div>
@endsection