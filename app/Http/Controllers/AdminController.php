<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class AdminController extends Controller
{
    public function index(){
        $user = Employee::count();
        return view('admin.index', compact('user'));
    }
}
