<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // report date from query (?date=YYYY-MM-DD)
        $date = $request->get('date', now()->toDateString());

        // dropdown employees
        $employees = Employee::select('id', 'first_name', 'last_name', 'department')
            ->orderBy('first_name')
            ->get();

        // report data (paginated)
        $attendances = Attendance::with('employee:id,first_name,last_name,department')
    ->whereDate('attendance_date', $date)
    ->orderBy('employee_id')
    ->paginate(config('constants.pagination_limit'))
    ->appends(['date' => $date]);
            
            // dd($attendances);exit();

        return view('admin.attendance.index', compact('employees', 'attendances', 'date'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id'      => 'required|integer|exists:employees,id',
            'attendance_date'  => 'required|date',
            'check_in_time'    => 'nullable|date_format:H:i',
            'check_out_time'   => 'nullable|date_format:H:i',
            'status'           => 'required|in:Present,Absent,Late,Half Day,Week Off',
            'remarks'          => 'nullable|string|max:500',
        ]);

        $workingMinutes = null;

        if (!empty($validated['check_in_time']) && !empty($validated['check_out_time'])) {
            $in  = Carbon::createFromFormat('H:i', $validated['check_in_time']);
            $out = Carbon::createFromFormat('H:i', $validated['check_out_time']);

            if ($out->greaterThan($in)) {
                $workingMinutes = $in->diffInMinutes($out);
            }
        }

        Attendance::updateOrCreate(
            [
                'employee_id'     => $validated['employee_id'],
                'attendance_date' => $validated['attendance_date'],
            ],
            [
                'check_in_time'    => $validated['check_in_time'] ?? null,
                'check_out_time'   => $validated['check_out_time'] ?? null,
                'status'           => $validated['status'],
                'remarks'          => $validated['remarks'] ?? null,
                'working_minutes'  => $workingMinutes,
            ]
        );

        // redirect same date report
        return redirect()
            ->route('admin.attendance.index', ['date' => $validated['attendance_date']])
            ->with('success', 'Attendance saved successfully.');
    }

    public function export(Request $request)
    {
        $date = $request->get('date', now()->toDateString());

        $rows = Attendance::with('employee:id,first_name,last_name,department')
            ->whereDate('attendance_date', $date)
            ->orderBy('employee_id')
            ->get();

        $filename = "attendance_{$date}.csv";

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Employee ID',
                'Name',
                'Department',
                'Date',
                'Check-in',
                'Check-out',
                'Status',
                'Working Hours',
                'Remarks',
            ]);

            foreach ($rows as $r) {
                $name = trim(($r->employee?->first_name ?? '') . ' ' . ($r->employee?->last_name ?? ''));
                $dept = $r->employee?->department ?? '-';

                $hours = '-';
                if ($r->working_minutes) {
                    $h = intdiv($r->working_minutes, 60);
                    $m = $r->working_minutes % 60;
                    $hours = "{$h}h {$m}m";
                }

                fputcsv($file, [
                    $r->employee_id,
                    $name ?: '-',
                    $dept,
                    optional($r->attendance_date)->format('Y-m-d'),
                    $r->check_in_time ?? '-',
                    $r->check_out_time ?? '-',
                    $r->status,
                    $hours,
                    $r->remarks ?? '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
