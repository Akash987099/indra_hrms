@extends('employee.layout.app')

@section('content')
<div class="">
    <div class="section-card">
        <h2 class="section-title">Attendance Management</h2>

        <!-- FILTER + EXPORT -->
        <form method="GET" action="{{ route('user.attendance.index') }}" class="mb-3">
            <div class="d-flex align-items-center gap-2">

                <select name="month" class="form-control" style="width:150px;">
                    @for ($m = 1; $m <= now()->month; $m++)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endfor
                </select>

                <input type="hidden" name="year" value="{{ now()->year }}">

                <button class="btn btn-primary">Filter</button>

                <a href="{{ route('user.attendance.export', ['month' => $month, 'year' => $year]) }}" 
                   class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
                &nbsp;
            {{-- <button class="btn btn-warning">
                <i class="fas fa-clock"></i> Request Regularization
            </button> --}}
            </div>
        </form>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Working Hours</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y (D)') }}</td>

                            <td>
                                {{ $attendance->check_in_time 
                                    ? \Carbon\Carbon::parse($attendance->check_in_time)->format('h:i A') 
                                    : '-' }}
                            </td>

                            <td>
                                {{ $attendance->check_out_time 
                                    ? \Carbon\Carbon::parse($attendance->check_out_time)->format('h:i A') 
                                    : '-' }}
                            </td>

                            <td>
                                @if($attendance->working_minutes)
                                    {{ floor($attendance->working_minutes / 60) }}h 
                                    {{ $attendance->working_minutes % 60 }}m
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <span class="badge 
                                    {{ $attendance->status == 'Present' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $attendance->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Attendance Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-end">
            {{ $attendances->appends(['month' => $month, 'year' => $year])->links() }}
        </div>
    </div>
</div>
@endsection