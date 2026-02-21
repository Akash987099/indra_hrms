<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\LeaveApplication;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // ✅ TOTAL STAFF
        $user = Employee::count();

        // ✅ PRESENT TODAY
        $presentToday = Attendance::whereDate('attendance_date', $today)
            ->whereNotNull('check_in_time')
            ->count();

        // ✅ ATTENDANCE %
        $attendancePercent = $user > 0 ? round(($presentToday / $user) * 100) : 0;

        // ✅ ON LEAVE
        $onLeave = LeaveApplication::where('status', 'Approved')
            ->whereDate('from_date', '<=', $today)
            ->whereDate('to_date', '>=', $today)
            ->count();

        // ✅ RECENT ACTIVITIES (ATTENDANCE + LEAVE)
        $recentAttendance = Attendance::with('employee')
            ->latest()
            ->take(5)
            ->get();

        $recentLeaves = LeaveApplication::with('employee')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'user',
            'presentToday',
            'attendancePercent',
            'onLeave',
            'recentAttendance',
            'recentLeaves'
        ));
    }
}