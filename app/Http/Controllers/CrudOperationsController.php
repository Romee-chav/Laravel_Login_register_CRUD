<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudOperations;

class CrudOperationsController extends Controller
{
    public function index(){
        $users = CrudOperations::paginate('10');
        return view('crud.dashboard',compact('users'));
    }

    public function create()
    {
        return view('crud.create');
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'contact' => 'required|numeric|min:10',
            'gender' => 'required',
            'hobbies' => 'required',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'profile' => 'required|mimes:jpeg,png,jpg,gif'
        ]);
        try {
            if ($request->hasFile('profile')) {
                $imgName = $request->profile->getClientOriginalName();
                $request->profile->move(public_path('profileImages/'),$imgName);
            }
            $crud = new CrudOperations;
            $crud->first_name = $request->first_name;
            $crud->last_name = $request->last_name;
            $crud->email = $request->email;
            $crud->contact = $request->contact;
            $crud->gender = $request->gender;
            $crud->hobbies = $request->hobbies;
            $crud->address = $request->address;
            $crud->profile = $imgName;
            $crud->save();
            return redirect()->route('dashboard')->with('success', 'Data Inserted Successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('danger', 'Data Not Inserted Successfully.');
        }
    }

    public function show(CrudOperations $crud)
    {
        return view('crud.show', compact('crud'));
    }

    public function edit(CrudOperations $crud)
    {
        return view('crud.edit', compact('crud'));
    }

    public function update(Request $request, CrudOperations $crud)
    {
        try {
            $crud->first_name = $request->first_name ?? $crud->first_name;
            $crud->last_name = $request->last_name ?? $crud->last_name;
            $crud->email = $request->email ?? $crud->email;
            $crud->contact = $request->contact ?? $crud->contact;
            $crud->gender = $request->gender ?? $crud->gender;
            $crud->hobbies = $request->hobbies ?? $crud->hobbies_arr;
            $crud->address = $request->address ?? $crud->address;
            if(isset($request->profile)) {
                $imgName = $request->profile->getClientOriginalName();
                $request->profile->move(public_path('profileImages/'),$imgName);
                $crud->profile = $imgName;
            }
            $crud->save();
            return redirect()->route('dashboard')->with('success', 'Data Updated Successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('danger', 'Data Not Updated Successfully.');
        }
    }

    public function destroy(CrudOperations $crud)
    {
        $crud->delete();
        return redirect()->route('dashboard')->with('success', 'Data Deleted Successfully.');
    }
}