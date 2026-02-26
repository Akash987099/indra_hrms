<?php

use App\Models\Module;

if (!function_exists('hasPermission')) {

    function hasPermission($moduleName, $type = 'view')
    {
        $user = auth()->guard('user')->user();

        if (!$user) return false;

        $department_id = $user->department;

        $module = Module::where('name', $moduleName)->first();

        if (!$module) return false;

        $permissions = json_decode($module->department_permissions, true);

        return $permissions[$department_id][$type] ?? false;
    }
}