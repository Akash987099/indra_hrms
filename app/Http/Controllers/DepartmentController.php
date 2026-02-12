<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('admin.department.index');
    }

    // fetch all
    public function list()
    {
        return response()->json(Department::latest()->get());
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Department::create([
            'name' => $request->name
        ]);

        return response()->json(['success' => true]);
    }

    // edit
    public function edit($id)
    {
        return response()->json(Department::findOrFail($id));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Department::findOrFail($id)->update([
            'name' => $request->name
        ]);

        return response()->json(['success' => true]);
    }

    // delete
    public function delete($id)
    {
        Department::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
}
