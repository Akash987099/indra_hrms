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
        $department_id = $request->department_id;
        $permissions = $request->permissions;

        $grouped = [];

        foreach ($permissions as $perm) {
            $grouped[$perm['module_id']][$perm['type']] = $perm['value'];
        }

        foreach ($grouped as $module_id => $perms) {

            $module = Module::find($module_id);

            $existing = json_decode($module->department_permissions, true) ?? [];

            // add/update this department
            $existing[$department_id] = array_merge([
                'view' => 0,
                'add' => 0,
                'edit' => 0,
                'delete' => 0
            ], $perms);

            $module->department_permissions = json_encode($existing);
            $module->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Permissions Saved'
        ]);
    }

    // 🔥 LOAD PERMISSIONS (EDIT)
    public function getPermissions($department_id)
    {
        $modules = Module::all();

        $data = [];

        foreach ($modules as $mod) {

            $permissions = json_decode($mod->department_permissions, true);

            $data[$mod->id] = $permissions[$department_id] ?? [
                'view' => 0,
                'add' => 0,
                'edit' => 0,
                'delete' => 0
            ];
        }

        return response()->json($data);
    }
}
