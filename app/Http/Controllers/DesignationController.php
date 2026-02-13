<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        return view('admin.designation.index');
    }

    // fetch all
    public function list()
    {
        return response()->json(Designation::latest()->get());
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Designation::create([
            'name' => $request->name
        ]);

        return response()->json(['success' => true]);
    }

    // edit
    public function edit($id)
    {
        return response()->json(Designation::findOrFail($id));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Designation::findOrFail($id)->update([
            'name' => $request->name
        ]);

        return response()->json(['success' => true]);
    }

    // delete
    public function delete($id)
    {
        Designation::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
}
