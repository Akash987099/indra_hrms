@extends('admin.layout.app')

@section('content')
<div class="main-content">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div id="attendance">

        <div class="dashboard-cards">

            <!-- MARK ATTENDANCE -->
            <div class="card">
                <div class="card-header">
                    <h3>Mark Attendance</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.attendance.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label>Employee</label>
                                <select name="employee_id" class="form-control" required>
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}">
                                            {{ $emp->first_name }} {{ $emp->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="attendance_date"
                                       value="{{ $date }}"
                                       class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Check In</label>
                                <input type="time" name="check_in_time" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Check Out</label>
                                <input type="time" name="check_out_time" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Late">Late</option>
                                <option value="Half Day">Half Day</option>
                                <option value="Week Off">Week Off</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary">Save Attendance</button>
                    </form>
                </div>
            </div>

            <!-- SHIFT CHART -->
            <div class="card">
                <div class="card-header">
                    <h3>Today's Summary</h3>
                </div>
                <div class="card-body">
                    <canvas id="shiftChart"></canvas>
                </div>
            </div>
        </div>

        <!-- REPORT -->
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between">

                <h3>Attendance Report</h3>

                <div>
                    <input type="date" id="attendanceReportDate"
                           value="{{ $date }}"
                           class="form-control d-inline" style="width:150px">

                    <button class="btn btn-primary" id="generateAttendanceReport">Filter</button>
                    <button class="btn btn-success" id="exportAttendanceBtn">Export</button>
                </div>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                            <th>Working Hours</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($attendances as $row)
                            <tr>
                                <td>{{ $row->employee_id }}</td>
                                <td>{{ $row->employee?->full_name }}</td>
                                <td>{{ $row->employee?->department }}</td>
                                <td>{{ $row->check_in_time ?? '-' }}</td>
                                <td>{{ $row->check_out_time ?? '-' }}</td>
                                <td>{{ $row->status }}</td>
                                <td>
                                    @if ($row->working_minutes)
                                        {{ intdiv($row->working_minutes, 60) }}h
                                        {{ $row->working_minutes % 60 }}m
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- PAGINATION -->
                {{ $attendances->links() }}
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('generateAttendanceReport').onclick = function () {
    let date = document.getElementById('attendanceReportDate').value;

    if (!date) return alert('Select date');

    window.location = "{{ route('admin.attendance.index') }}?date=" + date;
};

document.getElementById('exportAttendanceBtn').onclick = function () {
    let date = document.getElementById('attendanceReportDate').value;

    if (!date) return alert('Select date');

    window.location = "{{ route('admin.attendance.export') }}?date=" + date;
};
</script>

@endsection