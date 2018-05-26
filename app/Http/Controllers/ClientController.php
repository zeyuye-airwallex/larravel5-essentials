<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client as Client;

class ClientController extends Controller
{
    // ClientController
    protected $titles;
    protected $fields;

    public function __construct(Title $titles, Client $client)
    {
        $this->titles = $titles->all();
        $this->client = $client;
        $this->fields = [
            'name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'zip_code' => 'required|numeric',
            'city' => 'required',
            'state' => 'required',
            'email' => 'required|email',
        ];
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
        $data = [];
        $data['clients'] = $this->client->all();

//        $obj = new \stdClass();
//        $obj->id = 1;
//        $obj->title = 'mr';
//        $obj->name = 'john';
//        $obj->last_name = 'doe';
//        $obj->email = 'john@domain.com';
//
//        $data['clients'][] = $obj;
//
//        $obj = new \stdClass();
//        $obj->id = 2;
//        $obj->title = 'ms';
//        $obj->name = 'jane';
//        $obj->last_name = 'doe';
//        $obj->email = 'jane@another-domain.com';
//
//        $data['clients'][] = $obj;

        return view('client/index', $data);
    }

    public function new(Request $request)
    {
        $data = [];
        $data["titles"] = $this->titles;
        $data["action"] = "new";
        return view('client/new', $data);
    }

    public function create(Request $request)
    {
        $data = [];
        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');
        $this->validate(
            $request,
            $this->fields
        );

        $this->client->insert($data);
        return redirect()->route('clients');
    }

    public function show($client_id)
    {
        $data = [];
        $data["titles"] = $this->titles;
        $data["action"] = "show";
//        $data['client'] = $this->client->where('id', $client_id)->get()[0];
        $data['client'] = $this->client->find($client_id);
        return view('client/show', $data);
    }

    public function edit($client_id)
    {
        $data = [];
        $data["titles"] = $this->titles;
        $data["action"] = "edit";
//        $data['client'] = $this->client->where('id', $client_id)->get()[0];
        $data['client'] = $this->client->find($client_id);
        return view('client/edit', $data);
    }

    public function update($client_id, Request $request)
    {
        $data = [];
        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');
        $this->validate(
            $request,
            $this->fields
        );
        $client = $this->client->find($client_id);
        $client->title = $data['title'];
        $client->name = $data['name'];
        $client->last_name = $data['last_name'];
        $client->address = $data['address'];
        $client->zip_code = $data['zip_code'];
        $client->city = $data['city'];
        $client->state = $data['state'];
        $client->email = $data['email'];
        $client->save();
        return redirect()->route('show_client', ['client_id' => $client_id]);
    }

    public function delete($client_id)
    {
        $client = $this->client->find($client_id);
        $client -> delete();
        return $client;
    }
}
