<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // report date from query (?date=YYYY-MM-DD)
        $date = $request->get('date', now()->toDateString());

        // report data (paginated)
        $attendances = Attendance::with('employee:id,first_name,last_name,department')
            ->whereDate('attendance_date', $date)
            ->orderBy('id', 'desc')
            ->paginate(config('constants.pagination_limit'));

        // dd($attendances);exit();

        return view('employee.attendance.index', compact('attendances', 'date'));
    }

    public function store(Request $request)
    {
        $employee_id = Auth::guard('user')->user()->id;
        $today = Carbon::today();

        if ($request->type == 'checkin') {

            $exists = Attendance::where('employee_id', $employee_id)
                ->whereDate('attendance_date', $today)
                ->first();

            if (!$exists) {
                $attendance = Attendance::create([
                    'employee_id' => $employee_id,
                    'attendance_date' => $today,
                    'check_in_time' => now()->format('H:i:s'),
                    'status' => 'Present',
                ]);

                return response()->json([
                    'time' => now()->format('h:i A')
                ]);
            }

            return response()->json(['error' => 'Already checked in']);
        }

        if ($request->type == 'checkout') {

            $attendance = Attendance::where('employee_id', $employee_id)
                ->whereDate('attendance_date', $today)
                ->first();

            if ($attendance) {

                $checkIn = Carbon::parse($attendance->check_in_time);
                $checkOut = now();

                $minutes = $checkOut->diffInMinutes($checkIn);

                $attendance->update([
                    'check_out_time' => $checkOut->format('H:i:s'),
                    'working_minutes' => $minutes
                ]);

                return response()->json([
                    'time' => $checkOut->format('h:i A')
                ]);
            }
        }
    }

    public function get()
    {
        $employee_id = Auth::guard('user')->user()->id;
        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $employee_id)
            ->whereDate('attendance_date', $today)
            ->first();

        return response()->json([
            'check_in' => $attendance ? date('h:i A', strtotime($attendance->check_in_time)) : null,
            'check_out' => $attendance && $attendance->check_out_time ? date('h:i A', strtotime($attendance->check_out_time)) : null,
        ]);
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
