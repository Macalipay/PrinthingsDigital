<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseType;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;
use Carbon\Carbon;
class ExpenseController extends Controller
{
    
    public function rules($id)
    {
        return [
            'expense_date' => 'required | string | max:60',
            'expense_id' => 'required | string | max:60',
            'amount' => 'string | max:200',
            'description' => 'string | max:180',
            'payment_type' => 'max:60',
        ];
    }

    public function index()
    {
        $expenses = Expense::where('expense_date', Carbon::now()->format('Y-m-d'))->orderBy('id')->get();
        $expensetypes = ExpenseType::orderBy('id')->get();
        return view('backend.pages.expense.daily_expense',compact('expenses', 'expensetypes'));
    }

    public function overall()
    {
        $overallexpenses = Expense::orderBy('id')->get();
        $expensetypes = ExpenseType::orderBy('id')->get();
        return view('backend.pages.expense.overall_expense',compact('overallexpenses', 'expensetypes'));
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
                Expense::create($request->all());
    
                return redirect()->back()->with('success','Successfully Added');
            }
    }

    public function edit($id)
    {
        $expenses = Expense::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('expenses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Expense::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}