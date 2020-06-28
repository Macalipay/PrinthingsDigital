<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class CategoryController extends Controller
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
        $categories = Categories::orderBy('id')->get();
        return view('backend.pages.category.category',compact('categories'));
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
                $category = new Categories([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
                $category->save();
    
                return redirect()->back()->with('success','Successfully Added');
            }
    }

    public function edit($id)
    {
        $categories = Categories::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('categories'));
    }

    public function update(Request $request, $id)
    {
        Categories::find($id)->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return redirect()->back()->with('success','Successfully Deleted!');
    }
}
