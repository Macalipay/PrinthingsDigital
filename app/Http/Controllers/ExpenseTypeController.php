<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseType;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class ExpenseTypeController extends Controller
{
    public function rules($id)
    {
        return [
            'name' => 'required | string | max:60',
            'description' => 'required | string | max:60',
        ];
    }

    public function index()
    {
        $expensetypes = ExpenseType::orderBy('id')->get();
        return view('backend.pages.expense.expense_type',compact('expensetypes'));
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
                $expensetype = new ExpenseType([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
                $expensetype->save();
    
                return redirect()->back()->with('success','Successfully Added');
            }
    }

    public function edit($id)
    {
        $expensetypes = ExpenseType::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('expensetypes'));
    }

    public function update(Request $request, $id)
    {
        ExpenseType::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $expensetype = ExpenseType::find($id);
        $expensetype->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}

