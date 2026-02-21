<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\LeaveApplication;
use App\Models\Payroll;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user')->user();
        $employee_id = $user->id;

        $today = Carbon::today();

        // ✅ TODAY ATTENDANCE
        $todayAttendance = Attendance::where('employee_id', $employee_id)
            ->whereDate('attendance_date', $today)
            ->first();

        // ✅ ATTENDANCE SUMMARY (CURRENT MONTH)
        $presentDays = Attendance::where('employee_id', $employee_id)
            ->whereMonth('attendance_date', now()->month)
            ->where('status', 'Present')
            ->count();

        $absentDays = Attendance::where('employee_id', $employee_id)
            ->whereMonth('attendance_date', now()->month)
            ->where('status', 'Absent')
            ->count();

        $lateDays = 0; // agar late logic hai to yaha laga dena

        // ✅ RECENT ATTENDANCE (5)
        $recentAttendance = Attendance::where('employee_id', $employee_id)
            ->latest()
            ->take(5)
            ->get();

        // ✅ LEAVES
        $pendingLeaves = LeaveApplication::where('employee_id', $employee_id)
            ->where('status', 'Pending')
            ->count();

        $recentLeaves = LeaveApplication::where('employee_id', $employee_id)
            ->latest()
            ->take(5)
            ->get();

        // ✅ PAYROLL
        $latestPayroll = Payroll::where('employee_id', $employee_id)
            ->latest()
            ->first();

        return view('employee.index', compact(
            'todayAttendance',
            'presentDays',
            'absentDays',
            'lateDays',
            'recentAttendance',
            'pendingLeaves',
            'recentLeaves',
            'latestPayroll'
        ));
    }
}