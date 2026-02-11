@extends('admin.layout.app')

@section('content')
    <div class="main-content">

        <div id="attendance" class="">
            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <h3>Mark Attendance</h3>
                        <i class="fas fa-fingerprint"></i>
                    </div>
                    <div class="card-body">
                        <form id="markAttendanceForm" action="{{ route('admin.attendance.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="attendanceEmployee">Select Employee</label>
                                    <select id="attendanceEmployee" name="employee_id" class="form-control" required>
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="attendanceDate">Date</label>
                                    <input type="date" id="attendanceDate" name="attendance_date" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="checkInTime">Check-in Time</label>
                                    <input type="time" id="checkInTime" name="check_in_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="checkOutTime">Check-out Time</label>
                                    <input type="time" id="checkOutTime" name="check_out_time" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="attendanceStatus">Status</label>
                                <select id="attendanceStatus" name="status" class="form-control" required>
                                    <option value="Present">Present</option>
                                    <option value="Absent">Absent</option>
                                    <option value="Late">Late</option>
                                    <option value="Half Day">Half Day</option>
                                    <option value="Week Off">Week Off</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="attendanceRemarks">Remarks</label>
                                <textarea id="attendanceRemarks" name="remarks" class="form-control" rows="2" placeholder="Any remarks..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Mark Attendance</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Today's Shift Summary</h3>
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="shiftChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h3>Attendance Report</h3>
                    <div>
                        <input type="date"  id="attendanceReportDate" class="form-control"
                            style="width: auto; display: inline-block;">
                        <button class="btn btn-primary" id="generateAttendanceReport">Generate Report</button>
                        <button class="btn btn-success" id="exportAttendanceBtn">Export Excel</button>
                    </div>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                                <th>Working Hours</th>
                                <!--<th>Actions</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $row)
                                <tr>
                                    <td>{{ $row->employee_id }}</td>
                                    <td>{{ $row->employee?->full_name ?? '-' }}</td>
                                    <td>{{ $row->employee?->department ?? '-' }}</td>
                                    <td>{{ $row->check_in_time ?? '-' }}</td>
                                    <td>{{ $row->check_out_time ?? '-' }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>
                                        @if ($row->working_minutes)
                                            {{ intdiv($row->working_minutes, 60) }}h {{ $row->working_minutes % 60 }}m
                                        @else
                                            -
                                        @endif
                                    </td>
                                    {{-- <td>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
    document.getElementById('generateAttendanceReport').addEventListener('click', function () {
        const date = document.getElementById('attendanceReportDate').value;
        if (!date) return alert('Please select date');

        const url = new URL("{{ route('admin.attendance.index') }}", window.location.origin);
        url.searchParams.set('date', date);
        window.location.href = url.toString();
    });

    document.getElementById('exportAttendanceBtn').addEventListener('click', function () {
        const date = document.getElementById('attendanceReportDate').value;
        if (!date) return alert('Please select date');

        const url = new URL("{{ route('admin.attendance.export') }}", window.location.origin);
        url.searchParams.set('date', date);
        window.location.href = url.toString();
    });
</script>


    @endsection
