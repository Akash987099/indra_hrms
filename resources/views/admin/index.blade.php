@extends('admin.layout.app')

@section('content')

<div class="main-content">

    <!-- HEADER -->
    <div class="header">
        <h1>HRMS Dashboard</h1>

        <div class="header-info">

            <!-- ATTENDANCE -->
            <div class="stats-card">
                <div class="stats-icon icon-attendance">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stats-text">
                    <h3>{{ $attendancePercent }}%</h3>
                    <p>Attendance Today</p>
                </div>
            </div>

            <!-- ON LEAVE -->
            <div class="stats-card">
                <div class="stats-icon icon-leave">
                    <i class="fas fa-umbrella-beach"></i>
                </div>
                <div class="stats-text">
                    <h3>{{ $onLeave }}</h3>
                    <p>On Leave</p>
                </div>
            </div>

            <!-- PAYROLL -->
            <div class="stats-card">
                <div class="stats-icon icon-payroll">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="stats-text">
                    <h3>-</h3>
                    <p>Payroll Pending</p>
                </div>
            </div>

            <!-- TOTAL STAFF -->
            <div class="stats-card">
                <div class="stats-icon icon-staff">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-text">
                    <h3>{{ $user }}</h3>
                    <p>Total Staff</p>
                </div>
            </div>

        </div>
    </div>

    <!-- DASHBOARD -->
    <div class="dashboard-cards">

        <!-- ATTENDANCE SUMMARY -->
        <div class="card">
            <div class="card-header">
                <h3>Today's Attendance</h3>
                <span>{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
            </div>

            <div class="card-body">
                <p><strong>Present:</strong> {{ $presentToday }}</p>
                <p><strong>Total:</strong> {{ $user }}</p>
            </div>
        </div>

        <!-- HOLIDAYS -->
        <div class="card">
            <div class="card-header">
                <h3>Upcoming Holidays</h3>
            </div>

            <div class="card-body">
                <p>No holidays added</p>
            </div>
        </div>

        <!-- DEPARTMENT -->
        <div class="card">
            <div class="card-header">
                <h3>Department Headcount</h3>
            </div>

            <div class="card-body">
                <p>Coming Soon...</p>
            </div>
        </div>

    </div>

    <!-- RECENT ACTIVITIES -->
    <div class="card mt-4">
        <div class="card-header">
            <h3>Recent Activities</h3>
        </div>

        <div class="card-body">

            <!-- ATTENDANCE -->
            <h5>Attendance</h5>

            @forelse($recentAttendance as $att)
                <div class="mb-2 p-2 border rounded">
                    <strong>{{ $att->employee->first_name ?? '' }}</strong>
                    checked in on
                    {{ \Carbon\Carbon::parse($att->attendance_date)->format('d M') }}

                    @if($att->check_in_time)
                        at {{ date('h:i A', strtotime($att->check_in_time)) }}
                    @endif
                </div>
            @empty
                <p>No attendance records</p>
            @endforelse

            <hr>

            <!-- LEAVE -->
            <h5>Leave</h5>

            @forelse($recentLeaves as $leave)
                <div class="mb-2 p-2 border rounded">
                    <strong>{{ $leave->employee->first_name ?? '' }}</strong>
                    applied for <b>{{ $leave->leave_type }}</b> leave
                    ({{ $leave->from_date }} → {{ $leave->to_date }})
                </div>
            @empty
                <p>No leave records</p>
            @endforelse

        </div>
    </div>

</div>

@endsection