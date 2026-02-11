<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeePerformance;
use App\Models\EmployeeKpi;

class PerformanceController extends Controller
{
    public function index(){
        $employees = Employee::select('id','first_name','department')->get();
        return view('admin.performance.index', compact('employees'));
    }

    // KPI STORE
    public function storeKpi(Request $request){
        $request->validate([
            'employee_id' => 'required',
            'quarter' => 'required',
            'target' => 'required',
            'weightage' => 'required|numeric|min:1|max:100',
            'deadline' => 'required|date'
        ]);

        EmployeeKpi::create($request->all());

        return response()->json(['message' => 'KPI Added Successfully']);
    }

    // PERFORMANCE DATA
    public function performanceData(Request $request){
        $query = EmployeePerformance::with('employee');

        if($request->department){
            $query->whereHas('employee', function($q) use($request){
                $q->where('department', $request->department);
            });
        }

        return response()->json($query->get());
    }
}
