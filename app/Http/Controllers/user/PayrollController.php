<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index()
    {
        $employee_id = Auth::guard('user')->user()->id;

        // Payslip data
        $payrolls = Payroll::where('employee_id', $employee_id)
            ->orderBy('payroll_month', 'desc')
            ->paginate(10);

        // Dashboard calculations
        $currentSalary = Payroll::where('employee_id', $employee_id)
            ->latest()
            ->value('net_salary');

        $ytdEarnings = Payroll::where('employee_id', $employee_id)
            ->whereYear('payroll_month', now()->year)
            ->sum('net_salary');

        $taxPaid = Payroll::where('employee_id', $employee_id)
            ->whereYear('payroll_month', now()->year)
            ->sum('deductions');

        $nextPayday = Carbon::now()->endOfMonth()->format('d M');

        return view('employee.payroll.index', compact(
            'payrolls',
            'currentSalary',
            'ytdEarnings',
            'taxPaid',
            'nextPayday'
        ));
    }
}