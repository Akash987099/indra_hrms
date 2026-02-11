<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $department = $request->get('department', '');

        $query = Payroll::with('employee:id,first_name,last_name')
            ->where('payroll_month', $month);

        if ($department) {
            $query->where('department', $department);
        }

        $payrolls = $query->orderBy('id', 'desc')->get();

        $total = (float) $payrolls->sum('net_salary');
        $processed = (float) $payrolls->where('status', 'Processed')->sum('net_salary');
        $pending = (float) $payrolls->where('status', 'Pending')->sum('net_salary');

        return view('admin.payroll.index', compact('payrolls', 'month', 'department', 'total', 'processed', 'pending'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'payroll_month' => 'required|date_format:Y-m',
            'department' => 'nullable|string|max:100',
            'bonus_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $month = $validated['payroll_month'];
        $dept = $validated['department'] ?? null;
        $bonusPercent = (float) ($validated['bonus_percentage'] ?? 0);

        $employeesQuery = Employee::select('id','first_name','last_name','department','basic_salary','allowances','deductions');

        if ($dept) {
            $employeesQuery->where('department', $dept);
        }

        $employees = $employeesQuery->get();

        foreach ($employees as $emp) {

            $basic = (float) ($emp->basic_salary ?? 0);
            $allow = (float) ($emp->allowances ?? 0);
            $ded = (float) ($emp->deductions ?? 0);

            $bonusAmount = round(($basic * $bonusPercent) / 100, 2);
            $net = round(($basic + $allow + $bonusAmount) - $ded, 2);

            Payroll::updateOrCreate(
                [
                    'employee_id' => $emp->id,
                    'payroll_month' => $month,
                ],
                [
                    'department' => $emp->department ?? $dept,
                    'basic_salary' => $basic,
                    'allowances' => $allow,
                    'deductions' => $ded,
                    'bonus_percentage' => $bonusPercent,
                    'bonus_amount' => $bonusAmount,
                    'net_salary' => $net,
                    'status' => 'Processed',
                    'processed_at' => Carbon::now(),
                ]
            );
        }

        return redirect()->route('admin.payroll.index', ['month' => $month, 'department' => $dept])
            ->with('success', 'Payroll processed successfully.');
    }

    // ✅ Generate payslips (CSV download)
    public function payslips(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $department = $request->get('department', '');

        $query = Payroll::with('employee:id,first_name,last_name,department')
            ->where('payroll_month', $month);

        if ($department) {
            $query->where('department', $department);
        }

        $rows = $query->orderBy('employee_id')->get();

        $filename = "payslips_{$month}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($rows, $month) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Payroll Month',
                'Employee ID',
                'Name',
                'Department',
                'Basic Salary',
                'Allowances',
                'Deductions',
                'Bonus %',
                'Bonus Amount',
                'Net Salary',
                'Status',
            ]);

            foreach ($rows as $r) {
                $name = trim(($r->employee?->first_name ?? '') . ' ' . ($r->employee?->last_name ?? ''));

                fputcsv($file, [
                    $month,
                    $r->employee_id,
                    $name ?: '-',
                    $r->department ?? ($r->employee?->department ?? '-'),
                    $r->basic_salary,
                    $r->allowances,
                    $r->deductions,
                    $r->bonus_percentage,
                    $r->bonus_amount,
                    $r->net_salary,
                    $r->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
