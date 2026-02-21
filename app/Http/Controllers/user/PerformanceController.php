<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeePerformance;
use App\Models\EmployeeKpi;
use Carbon\Carbon;

class PerformanceController extends Controller
{
    public function index()
    {
        $employee_id = Auth::guard('user')->user()->id;

        // Latest Performance
        $performance = EmployeePerformance::where('employee_id', $employee_id)
            ->latest()
            ->first();

        // KPIs
        $kpis = EmployeeKpi::where('employee_id', $employee_id)->get();

        // Reviews (history)
        $reviews = EmployeePerformance::where('employee_id', $employee_id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('employee.performance.index', compact(
            'performance',
            'kpis',
            'reviews'
        ));
    }
}