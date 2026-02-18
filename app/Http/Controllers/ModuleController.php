<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        $department = Department::all();
        $module = Module::all();

        return view('admin.module.index', compact('department', 'module'));
    }

    public function store(Request $request)
    {
        $permissions = $request->permissions;

        foreach ($permissions as $perm) {

            $column = $perm['type'] == 'add' ? 'update' : $perm['type'];

            Module::where('id', $perm['module_id'])->update([
                $column => $perm['value']
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Permissions Updated Successfully'
        ]);
    }
}
