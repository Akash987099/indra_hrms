<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttendanceController extends Controller
{
    // ✅ LIST + FILTER + PAGINATION
    public function index(Request $request)
    {
        $employee_id = Auth::guard('user')->user()->id;

        $month = $request->get('month', now()->month);
        $year  = $request->get('year', now()->year);

        $attendances = Attendance::where('employee_id', $employee_id)
            ->whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->orderBy('attendance_date', 'desc')
            ->paginate(10);

        return view('employee.attendance.index', compact('attendances', 'month', 'year'));
    }

    // ✅ CHECKIN / CHECKOUT
    public function store(Request $request)
    {
        $employee_id = Auth::guard('user')->user()->id;
        $today = Carbon::today();

        if ($request->type == 'checkin') {

            $exists = Attendance::where('employee_id', $employee_id)
                ->whereDate('attendance_date', $today)
                ->first();

            if (!$exists) {
                Attendance::create([
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

    // ✅ TODAY DATA
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

    // ✅ EXPORT EXCEL (CSV)
    public function export(Request $request)
    {
        $employee_id = Auth::guard('user')->user()->id;

        $month = $request->get('month', now()->month);
        $year  = $request->get('year', now()->year);

        $attendances = Attendance::where('employee_id', $employee_id)
            ->whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->orderBy('attendance_date', 'desc')
            ->get();

        $filename = "attendance_{$month}_{$year}.csv";

        return new StreamedResponse(function () use ($attendances) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Date', 'Check In', 'Check Out', 'Working Hours', 'Status']);

            foreach ($attendances as $attendance) {

                $working = $attendance->working_minutes
                    ? floor($attendance->working_minutes / 60) . 'h ' . ($attendance->working_minutes % 60) . 'm'
                    : '-';

                fputcsv($handle, [
                    Carbon::parse($attendance->attendance_date)->format('d M Y'),
                    $attendance->check_in_time ? date('h:i A', strtotime($attendance->check_in_time)) : '-',
                    $attendance->check_out_time ? date('h:i A', strtotime($attendance->check_out_time)) : '-',
                    $working,
                    $attendance->status
                ]);
            }

            fclose($handle);
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ]);
    }
}