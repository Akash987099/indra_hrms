<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TraningController extends Controller
{
    public function index(){
        return view('employee.training.index');
    }
}
