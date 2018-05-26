<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ContentsController@home') -> name('home');
Route::get('/clients', 'ClientController@index') -> name('clients');
Route::get('/clients/new', 'ClientController@new') -> name('new_client');
Route::post('/clients/create', 'ClientController@create') -> name('create_client');

Route::get('/clients/{client_id}', 'ClientController@show') -> name('show_client');
Route::get('/clients/edit/{client_id}', 'ClientController@edit') -> name('edit_client');
Route::post('/clients/{client_id}', 'ClientController@update') -> name('update_client');
Route::delete('/clients/{client_id}', 'ClientController@delete') -> name('delete_client');

Route::get('/reservations/{client_id}/{room_id}/{date_in}/{date_out}', 'ReservationsController@index') -> name('reservations');
Route::post('/reservations/{room_id}', 'ReservationsController@book') -> name('book');
Route::get('/reservations/{reservation_id}', 'ReservationsController@show') -> name('show_reservation');
Route::delete('/reservations/{reservation_id}', 'ReservationsController@cancel') -> name('cancel_reservation');

Route::get('/rooms/{client_id}', 'RoomsController@checkAvailableRooms') -> name('check_room_default');
Route::post('/rooms/{client_id}', 'RoomsController@checkAvailableRooms') -> name('check_room');

Route::get('/about', function () {
    $response_arr = [];
    $response_arr['author'] = 'BP';
    $response_arr['version'] = '0.0.1';
    return $response_arr;
    //return view('welcome');
});

Route::get('/home', function () {
    $data = [];
    $data['version'] = '0.0.1';
    return view('welcome', $data);
});

Route::get('/di', 'ClientController@di');

Route::get('/facades/db', function () {
    return DB::select('SELECT * from table');
});

Route::get('/facades/encrypt', function () {
    return Crypt::encrypt('12345');
});

Route::get('facades/decrypt', function() {
    return Crypt::decrypt('eyJpdiI6IjRFNnB5UXRXblpCMm1UdUhuU3FDYmc9PSIsInZhbHVlIjoiNWVveGVubkgyaVg3cjlXTjhmZUt3QT09IiwibWFjIjoiYmY2NWU5MzJiMTc3NjhmYzMyNjRiNWU0MDRlMmE0MmM5ZTdhMjdiZjZjMDZiNDg4OTYwNTc5Yzk2MTFmN2UxMSJ9');
});