<?php

namespace App\Http\Controllers;

use App\SalesOrder;
use App\Client;
use App\Categories;
use App\Payment;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;
use Carbon\Carbon;
class SalesOrderController extends Controller
{
    public function rules($id)
    {
        return [
            'order_date' => 'required | string | max:60',
            'client_id' => 'required | string | max:200',
            'category_id' => 'string | max:180',
            'details' => 'max:180',
            'quantity' => 'required | string | max:180',
            'unit_price' => 'required | string | max:60',
            'due_date' => 'required | string | max:60',
        ];
    }

    public function index()
    {
        $sales_orders = SalesOrder::orderBy('id')->get();
        $clients = Client::orderBy('id')->get();
        $categories = Categories::orderBy('id')->get();
        return view('backend.pages.sales_order.sales_order',compact('sales_orders', 'clients', 'categories'));
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
                $code = SalesOrder::latest()->first();
                if ($code == null) {
                    $lastcode = 0;
                } else {
                    $lastcode = $code->id;
                }
                
                $date = str_replace('-', '', Carbon::today()->toDateString());

                $sales_order = new SalesOrder([
                    'code' => $date  . '-' . ($lastcode + 1) ,
                    'order_date' => $request->order_date,
                    'client_id' => $request->client_id,
                    'category_id' => $request->category_id,
                    'details' => $request->details,
                    'quantity' => $request->quantity,
                    'unit_price' => $request->unit_price,
                    'balance' => $request->unit_price,
                    'due_date' => $request->due_date,
                    'order_status' => $request->payment_status,
                ]);
                $sales_order->save();
    
                return redirect()->back()->with('success','Successfully Added');
            }
    }

    public function edit($id)
    {
        $sales_orders = SalesOrder::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('sales_orders'));
    }

    public function layout($type, $id, $value)
    {
        $sales_order = SalesOrder::where('id', $id)->orderBy('id')->firstOrFail();
        if($type == 'layout') {
            $sales_order->layout_status = $value;
            $sales_order->save();
        } else {
            $sales_order->order_status = $value;
            $sales_order->save();
        }
        // return response()->json(compact('sales_orders'));
    }

    public function update(Request $request, $id)
    {
        SalesOrder::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $sales_order = SalesOrder::find($id);
        $sales_order->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }

    public function payment(Request $request, $id)
    {
        $sales_order = SalesOrder::find($id);
        $sales_order->balance = $sales_order->balance - $request->paid_amount;
        $sales_order->paid_amount = $sales_order->paid_amount + $request->paid_amount;
        $sales_order->save();

        $payment = new Payment([
            'payment_date' => $request->payment_date ,
            'sales_order_id' => $id,
            'amount_paid' => $request->paid_amount,
            'type' => $request->type,
        ]);
        $payment->save();

        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
