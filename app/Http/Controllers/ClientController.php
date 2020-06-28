<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class ClientController extends Controller
{
    
    public function rules($id)
    {
        return [
            'firstname' => 'required | string | max:60',
            'lastname' => 'required | string | max:60',
            'address' => 'string | max:200',
            'contact' => 'string | max:180',
            'company' => 'max:60',
            'company_address' => 'string | max:180',
            'client_type' => 'required | string | max:60',
            'market_source' => 'required | string | max:60',
        ];
    }

    public function index()
    {
        $clients = Client::orderBy('id')->get();
        return view('backend.pages.client.client',compact('clients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules(''));
    
            if ($validator->fails()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ));
            } else {
                $client = new Client([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    'company' => $request->company,
                    'company_address' => $request->company_address,
                    'client_type' => $request->client_type,
                    'market_source' => $request->market_source,
                ]);
                $client->save();
    
                return redirect()->back()->with('success','Successfully Added');
            }
    }

    public function edit($id)
    {
        $clients = Client::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Client::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
