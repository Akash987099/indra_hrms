@extends('admin.layout.app')

@section('content')
    <style>
        th,
        td {
            padding: 5px !important;
            /* text-align: left; */
            border-bottom: 1px solid #ddd;
        }
    </style>
    <div class="main-content">
        <div id="leave" class="">
            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <h3>Apply Leave</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="card-body">
                        <form id="leaveForm" method="POST" action="{{ route('admin.leave.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="leaveEmployee">Employee</label>
                                <select id="leaveEmployee" name="employee_id" class="form-control" required>
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="leaveType">Leave Type</label>
                                <select id="leaveType" name="leave_type" class="form-control" required>
                                    <option value="Casual Leave">Casual Leave</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Earned Leave">Earned Leave</option>
                                    <option value="Maternity Leave">Maternity Leave</option>
                                    <option value="Paternity Leave">Paternity Leave</option>
                                    <option value="Compensatory Off">Compensatory Off</option>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="leaveFrom">From Date</label>
                                    <input type="date" id="leaveFrom" name="from_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="leaveTo">To Date</label>
                                    <input type="date" id="leaveTo" name="to_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="leaveDuration">Duration (Days)</label>
                                <input type="number" id="leaveDuration" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="leaveReason">Reason</label>
                                <textarea id="leaveReason" name="reason" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="leaveContact">Contact During Leave</label>
                                <input type="tel" id="leaveContact" name="contact_no" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Leave Request</button>
                        </form>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Leave Balance</h3>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-body">
                        <div class="leave-balance-card">
                            <h3>Available Leaves</h3>
                            <div style="display: flex; justify-content: space-around; margin-top: 20px;">
                                <div>
                                    <h2 id="casualLeaveBalance">{{ $balances['Casual Leave'] ?? 0 }}</h2>
                                    <p>Casual Leave</p>
                                </div>
                                <div>
                                    <h2 id="sickLeaveBalance">{{ $balances['Sick Leave'] ?? 0 }}</h2>
                                    <p>Sick Leave</p>
                                </div>
                                <div>
                                    <h2 id="earnedLeaveBalance">{{ $balances['Earned Leave'] ?? 0 }}</h2>
                                    <p>Earned Leave</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h3>Holiday Calendar</h3>
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="card-body">
                    <div id="holidayList">
                        <!-- Holidays will be loaded here -->
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h3>Leave Applications</h3>
                    <i class="fas fa-list"></i>
                </div>
                <div class="card-body">
                    <div class="filters">
                        <div class="filter-group">
                            <label for="leaveStatusFilter">Status</label>
                            <select id="leaveStatusFilter" class="form-control">
                                <option value="">All Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="leaveTypeFilter">Leave Type</label>
                            <select id="leaveTypeFilter" class="form-control">
                                <option value="">All Types</option>
                                <option value="Casual Leave">Casual Leave</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Earned Leave">Earned Leave</option>
                            </select>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Application Date</th>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>From - To</th>
                                <th>Duration</th>
                                <th>Remark</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        {{-- <tbody id="leaveTableBody">
                            </tbody> --}}
                        <tbody>
                            @forelse($leaves as $l)
                                <tr>
                                    <td>{{ $l->created_at?->format('d-m-Y') }}</td>
                                    <td>{{ $l->employee?->first_name }} {{ $l->employee?->last_name }}</td>
                                    <td>{{ $l->leave_type }}</td>
                                    <td>{{ $l->from_date?->format('d-m-Y') }} - {{ $l->to_date?->format('d-m-Y') }}</td>
                                    <td>{{ $l->duration_days }} day(s)</td>
                                    <td>{{ $l->action_remark ?? '-' }}</td>
                                    <td>{{ $l->status }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.leave.status', $l->id) }}"
                                            style="display:inline-block;">
                                            @csrf
                                            <input type="hidden" name="status" value="Approved">
                                            <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.leave.status', $l->id) }}"
                                            style="display:inline-block;">
                                            @csrf
                                            <input type="hidden" name="status" value="Rejected">
                                            <input type="text" name="action_remark" class="form-control mb-1"
                                                placeholder="Enter remark">
                                            <button class="btn btn-danger btn-sm" type="submit">Reject</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.leave.status', $l->id) }}"
                                            style="display:inline-block;">
                                            @csrf
                                            <button class="btn btn-secondary btn-sm" type="submit">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No leave applications found.</td>
                                </tr>
                            @endforelse
                        </tbody>

                        <div class="mt-3">
                            {{ $leaves->appends(['status' => $status, 'type' => $type])->links() }}
                        </div>

                    </table>
                </div>
            </div>
        </div>
    @endsection
