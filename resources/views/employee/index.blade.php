@extends('employee.layout.app')

@section('content')
    <!-- Sidebar -->

    <!-- Dashboard start-->

    <div class="page-content active" id="dashboard-page">
        <div class="dashboard-cards">

            <div class="card attendance">
                <div class="card-header">
                    <h3 class="card-title">Attendance Today</h3>
                    <div class="card-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>

                <div class="card-value" id="attendanceStatus">Absent</div>
                <p class="card-desc" id="attendanceTime">Not checked in</p>

                <div class="attendance-actions">
                    <button class="btn btn-success" id="checkInBtn">Check In</button>
                    <button class="btn btn-danger" id="checkOutBtn" disabled>Check Out</button>
                </div>
            </div>


            <div class="card leaves">
                <div class="card-header">
                    <h3 class="card-title">Leave Balance</h3>
                    <div class="card-icon">
                        <i class="fas fa-umbrella-beach"></i>
                    </div>
                </div>
                <div class="card-value" id="leaveBalance">12</div>
                <p class="card-desc" id="pendingLeaves">3 requests pending</p>
                <button class="btn btn-success" id="applyLeaveBtn">Apply Leave</button>
            </div>

            <div class="card payroll">
                <div class="card-header">
                    <h3 class="card-title">Payroll</h3>
                    <div class="card-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                </div>
                <div class="card-value">$4,850</div>
                <p class="card-desc">Next payroll: Jun 30</p>
                <button class="btn btn-warning" id="viewPayslipBtn">View Payslip</button>
            </div>

            <div class="card tasks">
                <div class="card-header">
                    <h3 class="card-title">Pending Tasks</h3>
                    <div class="card-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
                <div class="card-value" id="pendingTasks">5</div>
                <p class="card-desc" id="overdueTasks">2 overdue</p>
                <button class="btn btn-danger" id="viewTasksBtn">View Tasks</button>
            </div>
        </div>

        <div class="dashboard-sections">
            <div class="left-section">
                <div class="section-card">
                    <h2 class="section-title">
                        Attendance Summary
                        <a href="#" id="viewAttendanceReport">View Full Report</a>
                    </h2>
                    <div class="attendance-summary">
                        <div style="display: flex; justify-content: space-around; margin-bottom: 20px;">
                            <div style="text-align: center;">
                                <div style="font-size: 32px; font-weight: bold; color: var(--success);" id="presentDays">18
                                </div>
                                <div style="color: var(--gray);">Present</div>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 32px; font-weight: bold; color: var(--warning);" id="lateDays">2
                                </div>
                                <div style="color: var(--gray);">Late</div>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 32px; font-weight: bold; color: var(--accent);" id="absentDays">0
                                </div>
                                <div style="color: var(--gray);">Absent</div>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                            <tbody id="attendanceTable">
                                <!-- Filled by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="section-card">
                    <h2 class="section-title">
                        Recent Leave Requests
                        <a href="#" id="viewAllLeaves">View All</a>
                    </h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="leaveRequestsTable">
                            <!-- Filled by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="right-section">
                <div class="section-card">
                    <h2 class="section-title">
                        Upcoming Holidays
                        <a href="#" id="viewHolidayCalendar">View Calendar</a>
                    </h2>
                    <div id="holidaysList">
                        <!-- Filled by JavaScript -->
                    </div>
                </div>

                <div class="section-card">
                    <h2 class="section-title">Quick Actions</h2>
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                        <button class="btn btn-info" id="uploadDocBtn">
                            <i class="fas fa-file-upload"></i> Upload Doc
                        </button>
                        <button class="btn btn-info" id="updateProfileBtn">
                            <i class="fas fa-user-edit"></i> Update Profile
                        </button>
                        <button class="btn btn-info" id="downloadPayslipBtn">
                            <i class="fas fa-download"></i> Download Payslip
                        </button>
                        <button class="btn btn-info" id="requestTrainingBtn">
                            <i class="fas fa-graduation-cap"></i> Request Training
                        </button>
                        <button class="btn btn-info" id="regularizationBtn">
                            <i class="fas fa-clock"></i> Regularization
                        </button>
                        <button class="btn btn-info" id="helpDeskBtn">
                            <i class="fas fa-question-circle"></i> Help Desk
                        </button>
                    </div>
                </div>

                <div class="section-card">
                    <h2 class="section-title">
                        Announcements
                        <a href="#" id="viewAllAnnouncements">View All</a>
                    </h2>
                    <div id="announcementsList">
                        <!-- Filled by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dashboard Close --}}

    <!-- Settings Page -->
    
    </div>
    </main>

    <!-- Modals -->
    <!-- Leave Application Modal -->

    <!-- Notification Modal -->
    <div class="modal" id="notificationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Notifications</h3>
                <button class="modal-close" id="closeNotificationModal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="notificationsList">
                    <!-- Notifications will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="markAllReadBtn">Mark All as Read</button>
                <button class="btn btn-danger" id="clearNotificationsBtn">Clear All</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            console.log("JS Loaded ✅");

            $(document).on('click', '#checkInBtn', function() {

                console.log("CheckIn Clicked");

                $.ajax({
                    url: "{{ route('user.attendance.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        type: "checkin"
                    },
                    success: function(res) {

                        if (res.error) {
                            Swal.fire('Error!', res.error, 'error');
                            return;
                        }

                        $('#attendanceStatus').text('Present');
                        $('#attendanceTime').text('Checked in at ' + res.time);

                        $('#checkInBtn').prop('disabled', true).addClass('btn-disabled');
                        $('#checkOutBtn').prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Checked In!',
                            timer: 1200,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    }
                });
            });

            $(document).on('click', '#checkOutBtn', function() {

                $.ajax({
                    url: "{{ route('user.attendance.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        type: "checkout"
                    },
                    success: function(res) {

                        $('#attendanceTime').text('Checked out at ' + res.time);
                        $('#checkOutBtn').prop('disabled', true);

                        Swal.fire('Done!', 'Checked out successfully', 'success');
                    }
                });
            });

            $.get("{{ route('user.attendance.get') }}", function(res) {

                if (res.check_in) {
                    $('#attendanceStatus').text('Present');
                    $('#attendanceTime').text('Checked in at ' + res.check_in);

                    $('#checkInBtn').prop('disabled', true);
                    $('#checkOutBtn').prop('disabled', false);
                }

                if (res.check_out) {
                    $('#attendanceTime').text('Checked out at ' + res.check_out);
                    $('#checkOutBtn').prop('disabled', true);
                }
            });

        });
    </script>
@endsection
