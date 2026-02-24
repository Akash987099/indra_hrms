@extends('employee.layout.app')

@section('content')

<div class="page-content active">

    <!-- DASHBOARD CARDS -->
    <div class="dashboard-cards">

        <!-- ATTENDANCE -->
        <div class="card attendance">
            <h4>Attendance Today</h4>

            <div class="card-value" id="attendanceStatus">
                {{ $todayAttendance ? 'Present' : 'Absent' }}
            </div>

            <p id="attendanceTime">
                @if($todayAttendance && $todayAttendance->check_in_time)
                    Checked in at {{ \Carbon\Carbon::parse($todayAttendance->check_in_time)->format('h:i A') }}
                @else
                    Not checked in
                @endif
            </p>

            <button class="btn btn-success" id="checkInBtn"
                {{ $todayAttendance ? 'disabled' : '' }}>
                Check In
            </button>

            <button class="btn btn-danger" id="checkOutBtn"
                {{ ($todayAttendance && !$todayAttendance->check_out_time) ? '' : 'disabled' }}>
                Check Out
            </button>
        </div>

        <!-- LEAVE -->
        <div class="card">
            <h4>Leave</h4>
            <div class="card-value">{{ $pendingLeaves }}</div>
            <p>{{ $pendingLeaves }} Pending</p>
        </div>

        <!-- PAYROLL -->
        <div class="card">
            <h4>Salary</h4>
            <div class="card-value">
                ₹{{ number_format($latestPayroll->net_salary ?? 0) }}
            </div>
        </div>

    </div>

    <!-- ATTENDANCE SUMMARY -->
    <div class="section-card mt-4">
        <h3>Attendance Summary</h3>

        <div class="d-flex justify-content-around mb-3">
            <div>Present: {{ $presentDays }}</div>
            <div>Late: {{ $lateDays }}</div>
            <div>Absent: {{ $absentDays }}</div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentAttendance as $att)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($att->attendance_date)->format('d M') }}</td>
                        <td>{{ $att->check_in_time ? date('h:i A', strtotime($att->check_in_time)) : '-' }}</td>
                        <td>{{ $att->check_out_time ? date('h:i A', strtotime($att->check_out_time)) : '-' }}</td>
                        <td>{{ $att->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- LEAVE TABLE -->
    <div class="section-card mt-4">
        <h3>Recent Leaves</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Remark</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recentLeaves as $leave)
                    <tr>
                        <td>{{ $leave->leave_type }}</td>
                        <td>{{ $leave->from_date }}</td>
                        <td>{{ $leave->to_date }}</td>
                        <td>{{ $leave->action_remark }}</td>
                        <td>
                            <span class="badge bg-warning">{{ $leave->status }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- JS -->
<script>
$(document).ready(function(){

    // CHECK IN
    $('#checkInBtn').click(function(){
        $.post("{{ route('user.attendance.store') }}", {
            _token: "{{ csrf_token() }}",
            type: "checkin"
        }, function(res){

            if(res.error){
                alert(res.error);
                return;
            }

            $('#attendanceStatus').text('Present');
            $('#attendanceTime').text('Checked in at ' + res.time);

            $('#checkInBtn').prop('disabled', true);
            $('#checkOutBtn').prop('disabled', false);
        });
    });

    // CHECK OUT
    $('#checkOutBtn').click(function(){
        $.post("{{ route('user.attendance.store') }}", {
            _token: "{{ csrf_token() }}",
            type: "checkout"
        }, function(res){

            $('#attendanceTime').text('Checked out at ' + res.time);
            $('#checkOutBtn').prop('disabled', true);
        });
    });

});
</script>

@endsection