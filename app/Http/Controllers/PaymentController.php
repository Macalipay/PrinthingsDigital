<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class PaymentController extends Controller
{
  
    public function index()
    {
        $payments = Payment::orderBy('id')->get();
        return view('backend.pages.payment.payment',compact('payments'));
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
                $Payment = new Payment([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
                $Payment->save();
    
                return redirect()->back()->with('success','Successfully Added');
            }
    }

    public function edit($id)
    {
        $payments = Payment::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('payments'));
    }

    public function update(Request $request, $id)
    {
        Payment::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
