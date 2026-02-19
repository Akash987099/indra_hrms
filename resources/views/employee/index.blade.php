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

    <!-- Attendance Page -->


    <!-- Leaves Page -->
    <div class="page-content" id="leaves-page">
        <div class="section-card">
            <h2 class="section-title">Leave Management</h2>

            <div class="dashboard-cards" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Casual Leave</h3>
                    </div>
                    <div class="card-value" id="casualLeaveBalance">7</div>
                    <p class="card-desc">Days Available</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sick Leave</h3>
                    </div>
                    <div class="card-value" id="sickLeaveBalance">5</div>
                    <p class="card-desc">Days Available</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Earned Leave</h3>
                    </div>
                    <div class="card-value" id="earnedLeaveBalance">12</div>
                    <p class="card-desc">Days Available</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Leave Applications</h3>
                    </div>
                    <div class="card-value" id="totalApplications">8</div>
                    <p class="card-desc">This Year</p>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <button class="btn btn-success" id="newLeaveRequestBtn">
                    <i class="fas fa-plus"></i> New Leave Request
                </button>
                <button class="btn btn-info" id="leaveCalendarBtn">
                    <i class="fas fa-calendar"></i> View Leave Calendar
                </button>
            </div>

            <h3 style="margin-bottom: 20px;">My Leave Applications</h3>
            <table>
                <thead>
                    <tr>
                        <th>Application ID</th>
                        <th>Leave Type</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Duration</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="leaveApplicationsTable">
                    <!-- Filled by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payroll Page -->
    <div class="page-content" id="payroll-page">
        <div class="section-card">
            <h2 class="section-title">Payroll Information</h2>

            <div class="dashboard-cards" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Current Salary</h3>
                    </div>
                    <div class="card-value">$4,850</div>
                    <p class="card-desc">Monthly</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">YTD Earnings</h3>
                    </div>
                    <div class="card-value">$29,100</div>
                    <p class="card-desc">Year to Date</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tax Paid</h3>
                    </div>
                    <div class="card-value">$4,865</div>
                    <p class="card-desc">YTD</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Next Payday</h3>
                    </div>
                    <div class="card-value">Jun 30</div>
                    <p class="card-desc">Estimated: $4,850</p>
                </div>
            </div>

            <h3 style="margin-bottom: 20px;">Payslip History</h3>
            <table>
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Payment Date</th>
                        <th>Basic Salary</th>
                        <th>Allowances</th>
                        <th>Deductions</th>
                        <th>Net Salary</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="payslipHistoryTable">
                    <!-- Filled by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Performance Page -->
    <div class="page-content" id="performance-page">
        <div class="section-card">
            <h2 class="section-title">Performance Management</h2>

            <div class="dashboard-cards" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Current Rating</h3>
                    </div>
                    <div class="card-value">4.2</div>
                    <p class="card-desc">Out of 5.0</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Goals Completed</h3>
                    </div>
                    <div class="card-value">8/10</div>
                    <p class="card-desc">This Quarter</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Next Review</h3>
                    </div>
                    <div class="card-value">Jul 15</div>
                    <p class="card-desc">Quarterly Review</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Peer Feedback</h3>
                    </div>
                    <div class="card-value">4.5</div>
                    <p class="card-desc">Average Rating</p>
                </div>
            </div>

            <h3 style="margin-bottom: 20px;">Key Performance Indicators</h3>
            <div style="margin-bottom: 30px;">
                <div class="form-group">
                    <label class="form-label">Productivity</label>
                    <div class="progress-bar">
                        <div class="progress" style="width: 85%;"></div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>85%</span>
                        <span>Target: 80%</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Quality of Work</label>
                    <div class="progress-bar">
                        <div class="progress" style="width: 92%;"></div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>92%</span>
                        <span>Target: 85%</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Team Collaboration</label>
                    <div class="progress-bar">
                        <div class="progress" style="width: 78%;"></div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>78%</span>
                        <span>Target: 75%</span>
                    </div>
                </div>
            </div>

            <h3 style="margin-bottom: 20px;">Recent Appraisals</h3>
            <table>
                <thead>
                    <tr>
                        <th>Review Period</th>
                        <th>Reviewer</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="performanceReviewsTable">
                    <!-- Filled by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Training Page -->
    <div class="page-content" id="training-page">
        <div class="section-card">
            <h2 class="section-title">Training & Development</h2>

            <div class="dashboard-cards" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Completed</h3>
                    </div>
                    <div class="card-value">12</div>
                    <p class="card-desc">Trainings</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">In Progress</h3>
                    </div>
                    <div class="card-value">3</div>
                    <p class="card-desc">Trainings</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Certificates</h3>
                    </div>
                    <div class="card-value">8</div>
                    <p class="card-desc">Earned</p>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Required</h3>
                    </div>
                    <div class="card-value">2</div>
                    <p class="card-desc">Mandatory Trainings</p>
                </div>
            </div>

            <h3 style="margin-bottom: 20px;">Available Trainings</h3>
            <div class="training-cards" style="margin-bottom: 30px;" id="availableTrainings">
                <!-- Filled by JavaScript -->
            </div>

            <h3 style="margin-bottom: 20px;">My Training History</h3>
            <table>
                <thead>
                    <tr>
                        <th>Training Name</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Certificate</th>
                    </tr>
                </thead>
                <tbody id="trainingHistoryTable">
                    <!-- Filled by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Documents Page -->
    <div class="page-content" id="documents-page">
        <div class="section-card">
            <h2 class="section-title">Document Center</h2>

            <div style="margin-bottom: 30px;">
                <button class="btn btn-success" id="uploadNewDocBtn">
                    <i class="fas fa-upload"></i> Upload New Document
                </button>
                <button class="btn btn-info" id="requestDocumentBtn">
                    <i class="fas fa-file-medical"></i> Request Document
                </button>
            </div>

            <h3 style="margin-bottom: 20px;">My Documents</h3>
            <table>
                <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Type</th>
                        <th>Upload Date</th>
                        <th>Size</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="documentsTable">
                    <!-- Filled by JavaScript -->
                </tbody>
            </table>

            <h3 style="margin-top: 30px; margin-bottom: 20px;">Company Documents</h3>
            <table>
                <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Category</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="companyDocumentsTable">
                    <!-- Filled by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Profile Page -->
    <div class="page-content" id="profile-page">
        <div class="section-card">
            <h2 class="section-title">My Profile</h2>

            <div style="display: flex; gap: 30px; margin-bottom: 30px;">
                <div style="text-align: center;">
                    <div class="employee-avatar" style="width: 120px; height: 120px; font-size: 40px;">JS</div>
                    <button class="btn btn-info" style="margin-top: 15px;">
                        <i class="fas fa-camera"></i> Change Photo
                    </button>
                </div>

                <div style="flex: 1;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Employee ID</label>
                            <input type="text" class="form-control" value="EMP2023001" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="John Smith">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="john.smith@company.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" value="+1 (555) 123-4567">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            <input type="text" class="form-control" value="Engineering">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Position</label>
                            <input type="text" class="form-control" value="Software Developer">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Joining Date</label>
                            <input type="date" class="form-control" value="2023-01-15">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Employment Type</label>
                            <input type="text" class="form-control" value="Full-time">
                        </div>
                    </div>
                </div>
            </div>

            <h3 style="margin-bottom: 20px;">Emergency Contact</h3>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Contact Name</label>
                    <input type="text" class="form-control" value="Jane Smith">
                </div>
                <div class="form-group">
                    <label class="form-label">Relationship</label>
                    <input type="text" class="form-control" value="Spouse">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="tel" class="form-control" value="+1 (555) 987-6543">
                </div>
            </div>

            <div style="text-align: right; margin-top: 30px;">
                <button class="btn btn-success" id="saveProfileBtn">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Settings Page -->
    <div class="page-content" id="settings-page">
        <div class="section-card">
            <h2 class="section-title">Account Settings</h2>

            <h3 style="margin-bottom: 20px;">Change Password</h3>
            <div class="form-group">
                <label class="form-label">Current Password</label>
                <input type="password" class="form-control" id="currentPassword">
            </div>
            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" id="newPassword">
            </div>
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmPassword">
            </div>
            <button class="btn btn-success" id="changePasswordBtn">
                <i class="fas fa-key"></i> Change Password
            </button>

            <h3 style="margin-top: 30px; margin-bottom: 20px;">Notification Preferences</h3>
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" checked> Email notifications
                </label>
            </div>
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" checked> Leave approval notifications
                </label>
            </div>
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" checked> Payroll notifications
                </label>
            </div>
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox"> Training reminders
                </label>
            </div>

            <button class="btn btn-info" style="margin-top: 20px;">
                <i class="fas fa-bell"></i> Save Preferences
            </button>
        </div>
    </div>
    </div>
    </main>

    <!-- Modals -->
    <!-- Leave Application Modal -->
    <div class="modal" id="leaveApplicationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Apply for Leave</h3>
                <button class="modal-close" id="closeLeaveModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="leaveApplicationForm">
                    <div class="form-group">
                        <label class="form-label">Leave Type</label>
                        <select class="form-control" id="leaveType" required>
                            <option value="">Select Leave Type</option>
                            <option value="casual">Casual Leave</option>
                            <option value="sick">Sick Leave</option>
                            <option value="earned">Earned Leave</option>
                            <option value="maternity">Maternity Leave</option>
                            <option value="paternity">Paternity Leave</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" id="leaveFromDate" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" id="leaveToDate" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Number of Days</label>
                        <input type="number" class="form-control" id="leaveDays" min="0.5" max="30"
                            step="0.5" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Reason for Leave</label>
                        <textarea class="form-control" id="leaveReason" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact During Leave</label>
                        <input type="text" class="form-control" id="leaveContact" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Handover To</label>
                        <select class="form-control" id="handoverTo">
                            <option value="">Select Colleague</option>
                            <option value="EMP2023002">Sarah Johnson</option>
                            <option value="EMP2023003">Michael Brown</option>
                            <option value="EMP2023004">Emily Davis</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelLeaveBtn">Cancel</button>
                <button class="btn btn-success" id="submitLeaveBtn">Submit Application</button>
            </div>
        </div>
    </div>

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
