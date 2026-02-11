<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete HRMS - Employee Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --success: #27ae60;
            --warning: #f39c12;
            --info: #17a2b8;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --gray: #95a5a6;
            --sidebar-width: 250px;
            --header-height: 70px;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--primary);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .logo-container {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            background: rgba(0,0,0,0.2);
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo i {
            color: var(--secondary);
        }

        .nav-menu {
            list-style: none;
            padding: 20px 0;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 15px;
            cursor: pointer;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left: 4px solid var(--secondary);
        }

        .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        .employee-info {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .employee-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary), var(--info));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
            color: white;
        }

        .employee-details h4 {
            font-size: 15px;
            margin-bottom: 3px;
        }

        .employee-details p {
            font-size: 12px;
            color: rgba(255,255,255,0.7);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
        }

        .header {
            height: var(--header-height);
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header h1 {
            color: var(--primary);
            font-size: 24px;
        }

        .header-actions {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
            font-size: 20px;
            color: var(--gray);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .date-display {
            color: var(--gray);
            font-weight: 500;
        }

        .mobile-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--primary);
        }

        /* Content Area */
        .content-area {
            padding: 30px;
            min-height: calc(100vh - var(--header-height));
        }

        /* Dashboard Page */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 16px;
            color: var(--gray);
            font-weight: 600;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
        }

        .attendance .card-icon { background-color: var(--secondary); }
        .leaves .card-icon { background-color: var(--success); }
        .payroll .card-icon { background-color: var(--warning); }
        .tasks .card-icon { background-color: var(--accent); }
        .training .card-icon { background-color: var(--info); }
        .documents .card-icon { background-color: #8e44ad; }

        .card-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .card-desc {
            font-size: 14px;
            color: var(--gray);
        }

        .attendance-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-primary { background-color: var(--secondary); color: white; }
        .btn-success { background-color: var(--success); color: white; }
        .btn-danger { background-color: var(--accent); color: white; }
        .btn-warning { background-color: var(--warning); color: white; }
        .btn-info { background-color: var(--info); color: white; }
        .btn-disabled { opacity: 0.6; cursor: not-allowed; }

        .btn:hover:not(.btn-disabled) {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Dashboard Sections */
        .dashboard-sections {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .section-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title a {
            font-size: 14px;
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            text-align: left;
            padding: 15px;
            background-color: #f8f9fa;
            color: var(--primary);
            font-weight: 600;
            border-bottom: 1px solid #e0e0e0;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .approved { background-color: #d5f4e6; color: #27ae60; }
        .pending { background-color: #fef5e7; color: #f39c12; }
        .rejected { background-color: #fdedec; color: #e74c3c; }
        .present { background-color: #d5f4e6; color: #27ae60; }
        .absent { background-color: #fdedec; color: #e74c3c; }
        .late { background-color: #fef5e7; color: #f39c12; }
        .completed { background-color: #d5f4e6; color: #27ae60; }
        .in-progress { background-color: #e8f4fc; color: var(--secondary); }
        .overdue { background-color: #fdedec; color: #e74c3c; }

        /* Page Content */
        .page-content {
            display: none;
        }

        .page-content.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            transition: border 0.3s;
        }

        .form-control:focus {
            border-color: var(--secondary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 20px;
            color: var(--primary);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Leave Calendar */
        .calendar {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar-day {
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
        }

        .calendar-day:hover {
            background-color: #f0f0f0;
        }

        .calendar-day.header {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .calendar-day.weekend {
            background-color: #f9f9f9;
            color: var(--gray);
        }

        .calendar-day.holiday {
            background-color: #fff3cd;
            color: #856404;
        }

        .calendar-day.leave {
            background-color: #d4edda;
            color: #155724;
        }

        /* Training Cards */
        .training-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .training-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .training-card:hover {
            transform: translateY(-5px);
        }

        .training-card-header {
            background: var(--info);
            color: white;
            padding: 20px;
        }

        .training-card-body {
            padding: 20px;
        }

        .progress-bar {
            height: 8px;
            background-color: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin: 15px 0;
        }

        .progress {
            height: 100%;
            background-color: var(--success);
            border-radius: 4px;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .dashboard-sections {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-toggle {
                display: block;
            }
            
            .dashboard-cards {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .header {
                padding: 0 15px;
            }
            
            .content-area {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                height: auto;
                padding: 15px;
                gap: 15px;
            }
            
            .header-actions {
                align-self: stretch;
                justify-content: space-between;
            }
            
            .attendance-actions {
                flex-direction: column;
            }
        }

        /* Print Styles */
        @media print {
            .sidebar, .header, .btn {
                display: none !important;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .page-content {
                display: block !important;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="logo-container">
            <a href="#" class="logo">
                <i class="fas fa-users-cog"></i>
                <span>HRMS Pro</span>
            </a>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a class="nav-link active" data-page="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-page="attendance">
                    <i class="fas fa-calendar-check"></i>
                    <span>Attendance</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-page="leaves">
                    <i class="fas fa-umbrella-beach"></i>
                    <span>Leaves</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-page="payroll">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Payroll</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-page="performance">
                    <i class="fas fa-chart-line"></i>
                    <span>Performance</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-page="training">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Training</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-page="documents">
                    <i class="fas fa-file-alt"></i>
                    <span>Documents</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-page="profile">
                    <i class="fas fa-user-circle"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-page="settings">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
        
        <div class="employee-info">
            <div class="employee-avatar" id="userAvatar">JS</div>
            <div class="employee-details">
                <h4 id="userName">John Smith</h4>
                <p id="userPosition">Software Developer</p>
                <p id="userId">EMP2023001</p>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <div>
                <div class="mobile-toggle" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1 id="pageTitle">Dashboard</h1>
                <p class="date-display" id="currentDate"></p>
            </div>
            <div class="header-actions">
                <div class="notification-icon" id="notificationIcon">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge" id="notificationCount">3</span>
                </div>
                <button class="btn btn-danger" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="content-area">
            
            <!-- Dashboard Page -->
            <div class="page-content active" id="dashboard-page">
                <div class="dashboard-cards">
                    <div class="card attendance">
                        <div class="card-header">
                            <h3 class="card-title">Attendance Today</h3>
                            <div class="card-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </div>
                        <div class="card-value" id="attendanceStatus">Present</div>
                        <p class="card-desc" id="attendanceTime">Checked in at 9:05 AM</p>
                        <div class="attendance-actions">
                            <button class="btn btn-success btn-disabled" id="checkInBtn" disabled>Checked In</button>
                            <button class="btn btn-danger" id="checkOutBtn">Check Out</button>
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
                                        <div style="font-size: 32px; font-weight: bold; color: var(--success);" id="presentDays">18</div>
                                        <div style="color: var(--gray);">Present</div>
                                    </div>
                                    <div style="text-align: center;">
                                        <div style="font-size: 32px; font-weight: bold; color: var(--warning);" id="lateDays">2</div>
                                        <div style="color: var(--gray);">Late</div>
                                    </div>
                                    <div style="text-align: center;">
                                        <div style="font-size: 32px; font-weight: bold; color: var(--accent);" id="absentDays">0</div>
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
            
            <!-- Attendance Page -->
            <div class="page-content" id="attendance-page">
                <div class="section-card">
                    <h2 class="section-title">Attendance Management</h2>
                    <div class="attendance-actions" style="margin-bottom: 20px;">
                        <button class="btn btn-success" id="markAttendanceBtn">
                            <i class="fas fa-fingerprint"></i> Mark Attendance
                        </button>
                        <button class="btn btn-warning" id="requestRegularizationBtn">
                            <i class="fas fa-clock"></i> Request Regularization
                        </button>
                        <button class="btn btn-info" id="attendanceReportBtn">
                            <i class="fas fa-chart-bar"></i> Generate Report
                        </button>
                    </div>
                    
                    <div class="calendar" style="margin-bottom: 30px;">
                        <div class="calendar-header">
                            <button class="btn btn-secondary" id="prevMonthBtn">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <h3 id="currentMonth">June 2023</h3>
                            <button class="btn btn-secondary" id="nextMonthBtn">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="calendar-grid" id="attendanceCalendar">
                            <!-- Calendar will be generated by JavaScript -->
                        </div>
                    </div>
                    
                    <h3 style="margin-bottom: 20px;">Attendance History</h3>
                    <div style="margin-bottom: 20px;">
                        <select class="form-control" id="attendanceMonthFilter" style="width: 200px; display: inline-block;">
                            <option value="0">All Months</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6" selected>June</option>
                            <option value="7">July</option>
                        </select>
                        <button class="btn btn-primary" id="filterAttendanceBtn">Filter</button>
                        <button class="btn btn-secondary" id="exportAttendanceBtn">
                            <i class="fas fa-download"></i> Export to Excel
                        </button>
                    </div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Working Hours</th>
                                <th>Status</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="detailedAttendanceTable">
                            <!-- Filled by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
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
                        <input type="number" class="form-control" id="leaveDays" min="0.5" max="30" step="0.5" required>
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
    
    <!-- Regularization Modal -->
    <div class="modal" id="regularizationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Request Regularization</h3>
                <button class="modal-close" id="closeRegularizationModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="regularizationForm">
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" id="regularizationDate" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select class="form-control" id="regularizationType" required>
                            <option value="">Select Type</option>
                            <option value="forgot_checkin">Forgot Check-in</option>
                            <option value="forgot_checkout">Forgot Check-out</option>
                            <option value="late_entry">Late Entry</option>
                            <option value="early_exit">Early Exit</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Actual In Time</label>
                            <input type="time" class="form-control" id="actualInTime" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Actual Out Time</label>
                            <input type="time" class="form-control" id="actualOutTime">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Reason</label>
                        <textarea class="form-control" id="regularizationReason" rows="3" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Supporting Document</label>
                        <input type="file" class="form-control" id="regularizationDoc">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelRegularizationBtn">Cancel</button>
                <button class="btn btn-success" id="submitRegularizationBtn">Submit Request</button>
            </div>
        </div>
    </div>

    <script>
        // ==================== HRMS DATA STORAGE ====================
        const HRMSData = {
            // User Information
            user: {
                id: "EMP2023001",
                name: "John Smith",
                position: "Software Developer",
                department: "Engineering",
                email: "john.smith@company.com",
                phone: "+1 (555) 123-4567",
                joiningDate: "2023-01-15",
                avatar: "JS"
            },
            
            // Attendance Data
            attendance: [
                { date: '2023-06-01', checkIn: '9:05 AM', checkOut: '6:15 PM', status: 'present', hours: '9h 10m' },
                { date: '2023-06-02', checkIn: '9:15 AM', checkOut: '6:10 PM', status: 'late', hours: '8h 55m' },
                { date: '2023-06-05', checkIn: '8:55 AM', checkOut: '5:45 PM', status: 'present', hours: '8h 50m' },
                { date: '2023-06-06', checkIn: '9:00 AM', checkOut: '6:30 PM', status: 'present', hours: '9h 30m' },
                { date: '2023-06-07', checkIn: '9:10 AM', checkOut: '6:05 PM', status: 'late', hours: '8h 55m' },
                { date: '2023-06-08', checkIn: '8:50 AM', checkOut: '5:55 PM', status: 'present', hours: '9h 05m' },
                { date: '2023-06-09', checkIn: '9:20 AM', checkOut: '6:25 PM', status: 'late', hours: '9h 05m' },
                { date: '2023-06-12', checkIn: '9:00 AM', checkOut: '6:15 PM', status: 'present', hours: '9h 15m' }
            ],
            
            // Leave Data
            leaves: {
                balance: {
                    casual: 7,
                    sick: 5,
                    earned: 12,
                    maternity: 0,
                    paternity: 0
                },
                applications: [
                    { id: 'LV2023001', type: 'Sick Leave', from: '2023-06-10', to: '2023-06-12', days: 3, status: 'approved', appliedOn: '2023-06-05' },
                    { id: 'LV2023002', type: 'Casual Leave', from: '2023-06-18', to: '2023-06-19', days: 2, status: 'pending', appliedOn: '2023-06-15' },
                    { id: 'LV2023003', type: 'Earned Leave', from: '2023-07-01', to: '2023-07-05', days: 5, status: 'pending', appliedOn: '2023-06-20' },
                    { id: 'LV2023004', type: 'Casual Leave', from: '2023-05-22', to: '2023-05-22', days: 1, status: 'approved', appliedOn: '2023-05-18' },
                    { id: 'LV2023005', type: 'Sick Leave', from: '2023-04-15', to: '2023-04-16', days: 2, status: 'approved', appliedOn: '2023-04-14' }
                ]
            },
            
            // Payroll Data
            payroll: {
                currentSalary: 4850,
                ytdEarnings: 29100,
                ytdTax: 4865,
                nextPayday: '2023-06-30',
                payslips: [
                    { month: 'May 2023', date: '2023-05-31', basic: 4000, allowances: 850, deductions: 0, net: 4850, status: 'paid' },
                    { month: 'April 2023', date: '2023-04-28', basic: 4000, allowances: 850, deductions: 50, net: 4800, status: 'paid' },
                    { month: 'March 2023', date: '2023-03-31', basic: 4000, allowances: 850, deductions: 100, net: 4750, status: 'paid' },
                    { month: 'February 2023', date: '2023-02-28', basic: 4000, allowances: 850, deductions: 0, net: 4850, status: 'paid' },
                    { month: 'January 2023', date: '2023-01-31', basic: 4000, allowances: 850, deductions: 0, net: 4850, status: 'paid' }
                ]
            },
            
            // Performance Data
            performance: {
                rating: 4.2,
                goalsCompleted: 8,
                totalGoals: 10,
                nextReview: '2023-07-15',
                peerRating: 4.5,
                reviews: [
                    { period: 'Q1 2023', reviewer: 'Manager', rating: 4.0, feedback: 'Good performance, needs improvement in documentation', date: '2023-04-15' },
                    { period: 'Q4 2022', reviewer: 'Manager', rating: 4.3, feedback: 'Excellent work on the project delivery', date: '2023-01-10' },
                    { period: 'Q3 2022', reviewer: 'Manager', rating: 4.1, feedback: 'Meeting expectations, continue good work', date: '2022-10-05' }
                ]
            },
            
            // Training Data
            training: {
                completed: 12,
                inProgress: 3,
                certificates: 8,
                required: 2,
                available: [
                    { id: 1, name: 'Advanced JavaScript', category: 'Technical', duration: '8 hours', status: 'available' },
                    { id: 2, name: 'Project Management', category: 'Management', duration: '12 hours', status: 'available' },
                    { id: 3, name: 'Cybersecurity Basics', category: 'Security', duration: '6 hours', status: 'mandatory' },
                    { id: 4, name: 'Effective Communication', category: 'Soft Skills', duration: '4 hours', status: 'available' }
                ],
                history: [
                    { name: 'React Fundamentals', type: 'Technical', start: '2023-05-01', end: '2023-05-05', status: 'completed', score: '95%', certificate: 'Yes' },
                    { name: 'Agile Methodology', type: 'Management', start: '2023-04-15', end: '2023-04-20', status: 'completed', score: '88%', certificate: 'Yes' },
                    { name: 'Data Privacy', type: 'Compliance', start: '2023-06-01', end: '2023-06-10', status: 'in-progress', score: '--', certificate: 'No' },
                    { name: 'Leadership Skills', type: 'Soft Skills', start: '2023-03-01', end: '2023-03-05', status: 'completed', score: '92%', certificate: 'Yes' }
                ]
            },
            
            // Documents Data
            documents: {
                personal: [
                    { name: 'Offer Letter.pdf', type: 'Employment', date: '2023-01-10', size: '2.4 MB', status: 'approved' },
                    { name: 'Tax Form 2023.pdf', type: 'Tax', date: '2023-04-15', size: '1.8 MB', status: 'pending' },
                    { name: 'Degree Certificate.jpg', type: 'Education', date: '2023-02-20', size: '3.2 MB', status: 'approved' },
                    { name: 'Experience Letter.pdf', type: 'Employment', date: '2023-03-05', size: '1.5 MB', status: 'approved' }
                ],
                company: [
                    { name: 'Employee Handbook.pdf', category: 'Policy', date: '2023-05-01' },
                    { name: 'Code of Conduct.pdf', category: 'Policy', date: '2023-04-15' },
                    { name: 'Health Insurance Guide.pdf', category: 'Benefits', date: '2023-03-20' },
                    { name: 'IT Security Policy.pdf', category: 'Security', date: '2023-06-01' }
                ]
            },
            
            // Holidays Data
            holidays: [
                { date: '2023-06-15', name: 'Eid al-Adha', day: 'Thursday' },
                { date: '2023-07-01', name: 'Company Foundation Day', day: 'Saturday' },
                { date: '2023-08-15', name: 'Independence Day', day: 'Tuesday' },
                { date: '2023-09-07', name: 'Janmashtami', day: 'Thursday' },
                { date: '2023-10-02', name: 'Gandhi Jayanti', day: 'Monday' }
            ],
            
            // Notifications Data
            notifications: [
                { id: 1, title: 'Leave Approved', message: 'Your sick leave from Jun 10-12 has been approved', date: '2023-06-06', read: false },
                { id: 2, title: 'Payslip Available', message: 'May 2023 payslip is now available for download', date: '2023-06-01', read: false },
                { id: 3, title: 'Training Reminder', message: 'Cybersecurity training deadline approaching', date: '2023-06-05', read: false },
                { id: 4, title: 'Performance Review', message: 'Q2 performance review scheduled for Jul 15', date: '2023-06-10', read: true },
                { id: 5, title: 'Document Rejected', message: 'Your tax form needs corrections', date: '2023-06-08', read: true }
            ],
            
            // Announcements Data
            announcements: [
                { title: 'Office Party', message: 'Join us for the quarterly office party this Friday at 5 PM', date: '2023-06-09' },
                { title: 'System Maintenance', message: 'HRMS will be unavailable on Sunday from 2 AM to 6 AM', date: '2023-06-11' },
                { title: 'Health Checkup', message: 'Annual health checkup scheduled for next week', date: '2023-06-15' }
            ],
            
            // Task Data
            tasks: [
                { id: 1, title: 'Submit monthly report', dueDate: '2023-06-10', status: 'overdue' },
                { id: 2, title: 'Complete training module', dueDate: '2023-06-15', status: 'pending' },
                { id: 3, title: 'Update project documentation', dueDate: '2023-06-20', status: 'pending' },
                { id: 4, title: 'Team meeting preparation', dueDate: '2023-06-12', status: 'pending' },
                { id: 5, title: 'Submit expense claims', dueDate: '2023-06-08', status: 'overdue' }
            ]
        };

        // ==================== CORE FUNCTIONS ====================
        
        // Initialize the application
        function initHRMS() {
            updateCurrentDate();
            updateUserInfo();
            setupNavigation();
            setupEventListeners();
            loadDashboardData();
            loadAttendanceData();
            loadLeaveData();
            loadPayrollData();
            loadPerformanceData();
            loadTrainingData();
            loadDocumentsData();
            updateNotificationCount();
            
            // Set today's attendance status
            updateTodayAttendance();
        }
        
        // Update current date display
        function updateCurrentDate() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
        }
        
        // Update user information
        function updateUserInfo() {
            document.getElementById('userName').textContent = HRMSData.user.name;
            document.getElementById('userPosition').textContent = HRMSData.user.position;
            document.getElementById('userId').textContent = HRMSData.user.id;
            document.getElementById('userAvatar').textContent = HRMSData.user.avatar;
        }
        
        // Setup navigation between pages
        function setupNavigation() {
            const navLinks = document.querySelectorAll('.nav-link');
            const pageContents = document.querySelectorAll('.page-content');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const pageId = this.getAttribute('data-page');
                    
                    // Update active nav link
                    navLinks.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update page title
                    document.getElementById('pageTitle').textContent = this.querySelector('span').textContent;
                    
                    // Show selected page
                    pageContents.forEach(page => page.classList.remove('active'));
                    document.getElementById(`${pageId}-page`).classList.add('active');
                    
                    // Close mobile sidebar if open
                    if (window.innerWidth <= 768) {
                        document.getElementById('sidebar').classList.remove('active');
                    }
                });
            });
        }
        
        // Setup all event listeners
        function setupEventListeners() {
            // Mobile toggle
            document.getElementById('mobileToggle').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('active');
            });
            
            // Logout button
            document.getElementById('logoutBtn').addEventListener('click', function() {
                if (confirm('Are you sure you want to logout?')) {
                    alert('Logged out successfully!');
                    // In real app, redirect to login page
                    // window.location.href = 'login.html';
                }
            });
            
            // Notification icon
            document.getElementById('notificationIcon').addEventListener('click', function() {
                openNotificationModal();
            });
            
            // Check-out button
            document.getElementById('checkOutBtn').addEventListener('click', markCheckOut);
            
            // Apply leave button
            document.getElementById('applyLeaveBtn').addEventListener('click', function() {
                openLeaveApplicationModal();
            });
            
            // New leave request button
            document.getElementById('newLeaveRequestBtn').addEventListener('click', function() {
                openLeaveApplicationModal();
            });
            
            // Regularization button
            document.getElementById('regularizationBtn').addEventListener('click', function() {
                openRegularizationModal();
            });
            
            // Request regularization button
            document.getElementById('requestRegularizationBtn').addEventListener('click', function() {
                openRegularizationModal();
            });
            
            // Quick action buttons
            document.getElementById('uploadDocBtn').addEventListener('click', function() {
                alert('Upload document feature would open here');
            });
            
            document.getElementById('updateProfileBtn').addEventListener('click', function() {
                document.querySelector('.nav-link[data-page="profile"]').click();
            });
            
            document.getElementById('downloadPayslipBtn').addEventListener('click', function() {
                alert('Downloading latest payslip...');
            });
            
            // Modal close buttons
            document.getElementById('closeLeaveModal').addEventListener('click', closeLeaveModal);
            document.getElementById('closeNotificationModal').addEventListener('click', closeNotificationModal);
            document.getElementById('closeRegularizationModal').addEventListener('click', closeRegularizationModal);
            
            // Cancel buttons
            document.getElementById('cancelLeaveBtn').addEventListener('click', closeLeaveModal);
            document.getElementById('cancelRegularizationBtn').addEventListener('click', closeRegularizationModal);
            
            // Submit buttons
            document.getElementById('submitLeaveBtn').addEventListener('click', submitLeaveApplication);
            document.getElementById('submitRegularizationBtn').addEventListener('click', submitRegularizationRequest);
            
            // Mark all notifications as read
            document.getElementById('markAllReadBtn').addEventListener('click', markAllNotificationsAsRead);
            
            // Clear notifications
            document.getElementById('clearNotificationsBtn').addEventListener('click', clearAllNotifications);
            
            // Change password
            document.getElementById('changePasswordBtn').addEventListener('click', changePassword);
            
            // Save profile
            document.getElementById('saveProfileBtn').addEventListener('click', saveProfile);
            
            // Attendance month navigation
            document.getElementById('prevMonthBtn').addEventListener('click', showPreviousMonth);
            document.getElementById('nextMonthBtn').addEventListener('click', showNextMonth);
            
            // Filter attendance
            document.getElementById('filterAttendanceBtn').addEventListener('click', filterAttendance);
            
            // Export attendance
            document.getElementById('exportAttendanceBtn').addEventListener('click', exportAttendanceToExcel);
        }
        
        // ==================== DASHBOARD FUNCTIONS ====================
        
        function loadDashboardData() {
            // Update leave balance
            const totalLeaveBalance = HRMSData.leaves.balance.casual + 
                                    HRMSData.leaves.balance.sick + 
                                    HRMSData.leaves.balance.earned;
            document.getElementById('leaveBalance').textContent = totalLeaveBalance;
            
            // Update pending leaves count
            const pendingLeaves = HRMSData.leaves.applications.filter(leave => leave.status === 'pending').length;
            document.getElementById('pendingLeaves').textContent = `${pendingLeaves} requests pending`;
            
            // Update tasks count
            document.getElementById('pendingTasks').textContent = HRMSData.tasks.length;
            const overdueTasks = HRMSData.tasks.filter(task => task.status === 'overdue').length;
            document.getElementById('overdueTasks').textContent = `${overdueTasks} overdue`;
            
            // Update attendance summary
            updateAttendanceSummary();
            
            // Load attendance table
            loadAttendanceTable();
            
            // Load leave requests table
            loadLeaveRequestsTable();
            
            // Load holidays
            loadHolidaysList();
            
            // Load announcements
            loadAnnouncements();
        }
        
        function updateAttendanceSummary() {
            const presentDays = HRMSData.attendance.filter(a => a.status === 'present').length;
            const lateDays = HRMSData.attendance.filter(a => a.status === 'late').length;
            const absentDays = 0; // Assuming no absents in sample data
            
            document.getElementById('presentDays').textContent = presentDays;
            document.getElementById('lateDays').textContent = lateDays;
            document.getElementById('absentDays').textContent = absentDays;
        }
        
        function loadAttendanceTable() {
            const tableBody = document.getElementById('attendanceTable');
            tableBody.innerHTML = '';
            
            // Show only recent 5 records
            const recentAttendance = HRMSData.attendance.slice(0, 5);
            
            recentAttendance.forEach(record => {
                const row = document.createElement('tr');
                const statusClass = record.status === 'present' ? 'present' : 
                                  record.status === 'late' ? 'late' : 'absent';
                
                row.innerHTML = `
                    <td>${formatDate(record.date)}</td>
                    <td>${record.checkIn}</td>
                    <td>${record.checkOut}</td>
                    <td><span class="status-badge ${statusClass}">${record.status}</span></td>
                    <td>${record.hours}</td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function loadLeaveRequestsTable() {
            const tableBody = document.getElementById('leaveRequestsTable');
            tableBody.innerHTML = '';
            
            // Show only recent 3 records
            const recentLeaves = HRMSData.leaves.applications.slice(0, 3);
            
            recentLeaves.forEach(leave => {
                const row = document.createElement('tr');
                const statusClass = leave.status === 'approved' ? 'approved' : 
                                  leave.status === 'pending' ? 'pending' : 'rejected';
                
                row.innerHTML = `
                    <td>${leave.type}</td>
                    <td>${formatDate(leave.from)}</td>
                    <td>${formatDate(leave.to)}</td>
                    <td>${leave.days}</td>
                    <td><span class="status-badge ${statusClass}">${leave.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewLeaveDetails('${leave.id}')">View</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function loadHolidaysList() {
            const holidaysList = document.getElementById('holidaysList');
            holidaysList.innerHTML = '';
            
            const upcomingHolidays = HRMSData.holidays.filter(holiday => {
                const holidayDate = new Date(holiday.date);
                const today = new Date();
                return holidayDate >= today;
            }).slice(0, 3);
            
            if (upcomingHolidays.length === 0) {
                holidaysList.innerHTML = '<p>No upcoming holidays</p>';
                return;
            }
            
            upcomingHolidays.forEach(holiday => {
                const holidayDate = new Date(holiday.date);
                const holidayItem = document.createElement('div');
                holidayItem.className = 'holiday-item';
                holidayItem.style.display = 'flex';
                holidayItem.style.justifyContent = 'space-between';
                holidayItem.style.alignItems = 'center';
                holidayItem.style.padding = '10px 0';
                holidayItem.style.borderBottom = '1px solid #f0f0f0';
                
                holidayItem.innerHTML = `
                    <div>
                        <div style="font-weight: 600; color: var(--primary);">${holiday.name}</div>
                        <div style="font-size: 14px; color: var(--gray);">${holiday.day}</div>
                    </div>
                    <div style="background: var(--secondary); color: white; padding: 8px 15px; border-radius: 5px; font-weight: 600;">
                        ${formatDateShort(holiday.date)}
                    </div>
                `;
                
                holidaysList.appendChild(holidayItem);
            });
        }
        
        function loadAnnouncements() {
            const announcementsList = document.getElementById('announcementsList');
            announcementsList.innerHTML = '';
            
            HRMSData.announcements.forEach(announcement => {
                const announcementItem = document.createElement('div');
                announcementItem.style.marginBottom = '15px';
                announcementItem.innerHTML = `
                    <div style="font-weight: 600; color: var(--primary); margin-bottom: 5px;">
                        <i class="fas fa-bullhorn" style="color: var(--secondary); margin-right: 8px;"></i>
                        ${announcement.title}
                    </div>
                    <div style="font-size: 14px; color: var(--gray); margin-left: 25px;">
                        ${announcement.message}
                    </div>
                    <div style="font-size: 12px; color: var(--gray); margin-left: 25px; margin-top: 3px;">
                        ${formatDate(announcement.date)}
                    </div>
                `;
                announcementsList.appendChild(announcementItem);
            });
        }
        
        // ==================== ATTENDANCE FUNCTIONS ====================
        
        function loadAttendanceData() {
            loadDetailedAttendanceTable();
            generateAttendanceCalendar();
        }
        
        function loadDetailedAttendanceTable() {
            const tableBody = document.getElementById('detailedAttendanceTable');
            tableBody.innerHTML = '';
            
            HRMSData.attendance.forEach(record => {
                const row = document.createElement('tr');
                const statusClass = record.status === 'present' ? 'present' : 
                                  record.status === 'late' ? 'late' : 'absent';
                const day = new Date(record.date).toLocaleDateString('en-US', { weekday: 'short' });
                
                row.innerHTML = `
                    <td>${formatDate(record.date)}</td>
                    <td>${day}</td>
                    <td>${record.checkIn}</td>
                    <td>${record.checkOut}</td>
                    <td>${record.hours}</td>
                    <td><span class="status-badge ${statusClass}">${record.status}</span></td>
                    <td>${record.status === 'late' ? 'Late arrival' : 'Normal'}</td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function generateAttendanceCalendar() {
            const calendarGrid = document.getElementById('attendanceCalendar');
            calendarGrid.innerHTML = '';
            
            // Add day headers
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            days.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day header';
                dayElement.textContent = day;
                calendarGrid.appendChild(dayElement);
            });
            
            // Get current month and year
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth();
            const currentYear = currentDate.getFullYear();
            
            // Update month display
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 
                              'July', 'August', 'September', 'October', 'November', 'December'];
            document.getElementById('currentMonth').textContent = `${monthNames[currentMonth]} ${currentYear}`;
            
            // Get first day of month
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            
            // Get days in month
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            
            // Add empty cells for days before first day of month
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'calendar-day';
                calendarGrid.appendChild(emptyCell);
            }
            
            // Add days of month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                dayElement.textContent = day;
                
                // Check if day is weekend
                const dayOfWeek = new Date(currentYear, currentMonth, day).getDay();
                if (dayOfWeek === 0 || dayOfWeek === 6) {
                    dayElement.classList.add('weekend');
                }
                
                // Check if day has attendance record
                const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const attendanceRecord = HRMSData.attendance.find(a => a.date === dateStr);
                
                if (attendanceRecord) {
                    dayElement.classList.add(attendanceRecord.status === 'present' ? 'present' : 'late');
                    dayElement.title = `${attendanceRecord.status.charAt(0).toUpperCase() + attendanceRecord.status.slice(1)}: ${attendanceRecord.checkIn} - ${attendanceRecord.checkOut}`;
                }
                
                calendarGrid.appendChild(dayElement);
            }
        }
        
        function updateTodayAttendance() {
            const today = new Date().toISOString().split('T')[0];
            const todayRecord = HRMSData.attendance.find(a => a.date === today);
            
            if (todayRecord) {
                document.getElementById('attendanceStatus').textContent = todayRecord.status.charAt(0).toUpperCase() + todayRecord.status.slice(1);
                document.getElementById('attendanceTime').textContent = `Checked in at ${todayRecord.checkIn}`;
                document.getElementById('checkInBtn').disabled = true;
                document.getElementById('checkInBtn').classList.add('btn-disabled');
                document.getElementById('checkInBtn').textContent = 'Checked In';
                
                if (todayRecord.checkOut) {
                    document.getElementById('checkOutBtn').disabled = true;
                    document.getElementById('checkOutBtn').classList.add('btn-disabled');
                    document.getElementById('checkOutBtn').textContent = 'Checked Out';
                }
            } else {
                document.getElementById('attendanceStatus').textContent = 'Not Checked In';
                document.getElementById('attendanceTime').textContent = 'Please check in';
                document.getElementById('checkInBtn').disabled = false;
                document.getElementById('checkInBtn').classList.remove('btn-disabled');
                document.getElementById('checkInBtn').textContent = 'Check In';
            }
        }
        
        function markCheckOut() {
            const today = new Date().toISOString().split('T')[0];
            const checkOutTime = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            
            // Find today's record
            const todayIndex = HRMSData.attendance.findIndex(a => a.date === today);
            
            if (todayIndex !== -1) {
                // Update existing record
                HRMSData.attendance[todayIndex].checkOut = checkOutTime + ' PM';
                HRMSData.attendance[todayIndex].hours = '8h 55m';
            } else {
                // Add new record (should not happen in real scenario)
                HRMSData.attendance.unshift({
                    date: today,
                    checkIn: '9:05 AM',
                    checkOut: checkOutTime + ' PM',
                    status: 'present',
                    hours: '8h 55m'
                });
            }
            
            // Update UI
            document.getElementById('attendanceStatus').textContent = 'Checked Out';
            document.getElementById('attendanceTime').textContent = `Checked out at ${checkOutTime} PM`;
            document.getElementById('checkOutBtn').disabled = true;
            document.getElementById('checkOutBtn').classList.add('btn-disabled');
            document.getElementById('checkOutBtn').textContent = 'Checked Out';
            
            // Refresh attendance table
            loadAttendanceTable();
            loadDetailedAttendanceTable();
            updateAttendanceSummary();
            
            alert('Successfully checked out!');
        }
        
        function showPreviousMonth() {
            alert('Previous month would be shown here');
            // In full implementation, this would change the calendar view
        }
        
        function showNextMonth() {
            alert('Next month would be shown here');
            // In full implementation, this would change the calendar view
        }
        
        function filterAttendance() {
            const selectedMonth = document.getElementById('attendanceMonthFilter').value;
            alert(`Filtering attendance for month: ${selectedMonth}`);
            // In full implementation, this would filter the attendance table
        }
        
        function exportAttendanceToExcel() {
            alert('Exporting attendance data to Excel...');
            // In full implementation, this would generate and download an Excel file
        }
        
        // ==================== LEAVE FUNCTIONS ====================
        
        function loadLeaveData() {
            // Update leave balance cards
            document.getElementById('casualLeaveBalance').textContent = HRMSData.leaves.balance.casual;
            document.getElementById('sickLeaveBalance').textContent = HRMSData.leaves.balance.sick;
            document.getElementById('earnedLeaveBalance').textContent = HRMSData.leaves.balance.earned;
            document.getElementById('totalApplications').textContent = HRMSData.leaves.applications.length;
            
            // Load leave applications table
            loadLeaveApplicationsTable();
        }
        
        function loadLeaveApplicationsTable() {
            const tableBody = document.getElementById('leaveApplicationsTable');
            tableBody.innerHTML = '';
            
            HRMSData.leaves.applications.forEach(leave => {
                const row = document.createElement('tr');
                const statusClass = leave.status === 'approved' ? 'approved' : 
                                  leave.status === 'pending' ? 'pending' : 'rejected';
                
                row.innerHTML = `
                    <td>${leave.id}</td>
                    <td>${leave.type}</td>
                    <td>${formatDate(leave.from)}</td>
                    <td>${formatDate(leave.to)}</td>
                    <td>${leave.days}</td>
                    <td>${formatDate(leave.appliedOn)}</td>
                    <td><span class="status-badge ${statusClass}">${leave.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewLeaveDetails('${leave.id}')">View</button>
                        ${leave.status === 'pending' ? 
                          `<button class="btn btn-sm btn-danger" onclick="cancelLeave('${leave.id}')">Cancel</button>` : 
                          ''}
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function openLeaveApplicationModal() {
            document.getElementById('leaveApplicationModal').classList.add('active');
            
            // Set default values
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            document.getElementById('leaveFromDate').valueAsDate = tomorrow;
            document.getElementById('leaveToDate').valueAsDate = tomorrow;
            document.getElementById('leaveDays').value = 1;
        }
        
        function closeLeaveModal() {
            document.getElementById('leaveApplicationModal').classList.remove('active');
            document.getElementById('leaveApplicationForm').reset();
        }
        
        function submitLeaveApplication() {
            const leaveType = document.getElementById('leaveType').value;
            const fromDate = document.getElementById('leaveFromDate').value;
            const toDate = document.getElementById('leaveToDate').value;
            const days = document.getElementById('leaveDays').value;
            const reason = document.getElementById('leaveReason').value;
            
            if (!leaveType || !fromDate || !toDate || !days || !reason) {
                alert('Please fill in all required fields');
                return;
            }
            
            // Generate new leave ID
            const newId = `LV${new Date().getFullYear()}${String(HRMSData.leaves.applications.length + 1).padStart(4, '0')}`;
            
            // Add new leave application
            const newLeave = {
                id: newId,
                type: leaveType.charAt(0).toUpperCase() + leaveType.slice(1) + ' Leave',
                from: fromDate,
                to: toDate,
                days: parseFloat(days),
                status: 'pending',
                appliedOn: new Date().toISOString().split('T')[0]
            };
            
            HRMSData.leaves.applications.unshift(newLeave);
            
            // Update UI
            loadLeaveApplicationsTable();
            loadLeaveRequestsTable();
            
            // Update leave balance on dashboard
            const totalLeaveBalance = HRMSData.leaves.balance.casual + 
                                    HRMSData.leaves.balance.sick + 
                                    HRMSData.leaves.balance.earned;
            document.getElementById('leaveBalance').textContent = totalLeaveBalance;
            
            // Update pending leaves count
            const pendingLeaves = HRMSData.leaves.applications.filter(leave => leave.status === 'pending').length;
            document.getElementById('pendingLeaves').textContent = `${pendingLeaves} requests pending`;
            
            // Close modal
            closeLeaveModal();
            
            // Show success message
            alert('Leave application submitted successfully!');
        }
        
        function viewLeaveDetails(leaveId) {
            const leave = HRMSData.leaves.applications.find(l => l.id === leaveId);
            if (leave) {
                alert(`Leave Details:\n\nID: ${leave.id}\nType: ${leave.type}\nFrom: ${formatDate(leave.from)}\nTo: ${formatDate(leave.to)}\nDays: ${leave.days}\nStatus: ${leave.status}\nApplied On: ${formatDate(leave.appliedOn)}`);
            }
        }
        
        function cancelLeave(leaveId) {
            if (confirm('Are you sure you want to cancel this leave application?')) {
                const index = HRMSData.leaves.applications.findIndex(l => l.id === leaveId);
                if (index !== -1) {
                    HRMSData.leaves.applications.splice(index, 1);
                    loadLeaveApplicationsTable();
                    loadLeaveRequestsTable();
                    alert('Leave application cancelled successfully!');
                }
            }
        }
        
        // ==================== PAYROLL FUNCTIONS ====================
        
        function loadPayrollData() {
            const tableBody = document.getElementById('payslipHistoryTable');
            tableBody.innerHTML = '';
            
            HRMSData.payroll.payslips.forEach(payslip => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${payslip.month}</td>
                    <td>${formatDate(payslip.date)}</td>
                    <td>$${payslip.basic.toLocaleString()}</td>
                    <td>$${payslip.allowances.toLocaleString()}</td>
                    <td>$${payslip.deductions.toLocaleString()}</td>
                    <td><strong>$${payslip.net.toLocaleString()}</strong></td>
                    <td><span class="status-badge approved">${payslip.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewPayslip('${payslip.month}')">View</button>
                        <button class="btn btn-sm btn-success" onclick="downloadPayslip('${payslip.month}')">Download</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function viewPayslip(month) {
            alert(`Viewing payslip for ${month}`);
            // In full implementation, this would open a detailed payslip view
        }
        
        function downloadPayslip(month) {
            alert(`Downloading payslip for ${month}...`);
            // In full implementation, this would download the PDF
        }
        
        // ==================== PERFORMANCE FUNCTIONS ====================
        
        function loadPerformanceData() {
            const tableBody = document.getElementById('performanceReviewsTable');
            tableBody.innerHTML = '';
            
            HRMSData.performance.reviews.forEach(review => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${review.period}</td>
                    <td>${review.reviewer}</td>
                    <td>${review.rating}/5.0</td>
                    <td>${review.feedback}</td>
                    <td>${formatDate(review.date)}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewPerformanceReview('${review.period}')">Details</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function viewPerformanceReview(period) {
            const review = HRMSData.performance.reviews.find(r => r.period === period);
            if (review) {
                alert(`Performance Review for ${period}:\n\nReviewer: ${review.reviewer}\nRating: ${review.rating}/5.0\nFeedback: ${review.feedback}\nDate: ${formatDate(review.date)}`);
            }
        }
        
        // ==================== TRAINING FUNCTIONS ====================
        
        function loadTrainingData() {
            // Load available trainings
            const availableTrainings = document.getElementById('availableTrainings');
            availableTrainings.innerHTML = '';
            
            HRMSData.training.available.forEach(training => {
                const trainingCard = document.createElement('div');
                trainingCard.className = 'training-card';
                trainingCard.innerHTML = `
                    <div class="training-card-header">
                        <h3 style="margin: 0; color: white;">${training.name}</h3>
                        <div style="font-size: 14px; opacity: 0.9;">${training.category}</div>
                    </div>
                    <div class="training-card-body">
                        <p><i class="fas fa-clock"></i> Duration: ${training.duration}</p>
                        <p><i class="fas fa-tag"></i> Status: ${training.status}</p>
                        <button class="btn btn-success" onclick="enrollInTraining(${training.id})">Enroll Now</button>
                    </div>
                `;
                availableTrainings.appendChild(trainingCard);
            });
            
            // Load training history
            const tableBody = document.getElementById('trainingHistoryTable');
            tableBody.innerHTML = '';
            
            HRMSData.training.history.forEach(training => {
                const row = document.createElement('tr');
                const statusClass = training.status === 'completed' ? 'completed' : 
                                  training.status === 'in-progress' ? 'in-progress' : 'overdue';
                
                row.innerHTML = `
                    <td>${training.name}</td>
                    <td>${training.type}</td>
                    <td>${formatDate(training.start)}</td>
                    <td>${formatDate(training.end)}</td>
                    <td><span class="status-badge ${statusClass}">${training.status}</span></td>
                    <td>${training.score}</td>
                    <td>
                        ${training.certificate === 'Yes' ? 
                          `<button class="btn btn-sm btn-success" onclick="downloadCertificate('${training.name}')">Download</button>` : 
                          'Not Available'}
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function enrollInTraining(trainingId) {
            const training = HRMSData.training.available.find(t => t.id === trainingId);
            if (training) {
                if (confirm(`Enroll in "${training.name}"?`)) {
                    alert(`Successfully enrolled in ${training.name}!`);
                }
            }
        }
        
        function downloadCertificate(trainingName) {
            alert(`Downloading certificate for ${trainingName}...`);
        }
        
        // ==================== DOCUMENT FUNCTIONS ====================
        
        function loadDocumentsData() {
            // Load personal documents
            const personalTableBody = document.getElementById('documentsTable');
            personalTableBody.innerHTML = '';
            
            HRMSData.documents.personal.forEach(doc => {
                const row = document.createElement('tr');
                const statusClass = doc.status === 'approved' ? 'approved' : 
                                  doc.status === 'pending' ? 'pending' : 'rejected';
                
                row.innerHTML = `
                    <td>${doc.name}</td>
                    <td>${doc.type}</td>
                    <td>${formatDate(doc.date)}</td>
                    <td>${doc.size}</td>
                    <td><span class="status-badge ${statusClass}">${doc.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewDocument('${doc.name}')">View</button>
                        <button class="btn btn-sm btn-success" onclick="downloadDocument('${doc.name}')">Download</button>
                        ${doc.status === 'pending' ? 
                          `<button class="btn btn-sm btn-danger" onclick="deleteDocument('${doc.name}')">Delete</button>` : 
                          ''}
                    </td>
                `;
                personalTableBody.appendChild(row);
            });
            
            // Load company documents
            const companyTableBody = document.getElementById('companyDocumentsTable');
            companyTableBody.innerHTML = '';
            
            HRMSData.documents.company.forEach(doc => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${doc.name}</td>
                    <td>${doc.category}</td>
                    <td>${formatDate(doc.date)}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewDocument('${doc.name}')">View</button>
                        <button class="btn btn-sm btn-success" onclick="downloadDocument('${doc.name}')">Download</button>
                    </td>
                `;
                companyTableBody.appendChild(row);
            });
        }
        
        function viewDocument(docName) {
            alert(`Viewing document: ${docName}`);
        }
        
        function downloadDocument(docName) {
            alert(`Downloading document: ${docName}...`);
        }
        
        function deleteDocument(docName) {
            if (confirm(`Are you sure you want to delete ${docName}?`)) {
                alert(`Document ${docName} deleted successfully!`);
                // In full implementation, remove from array and refresh table
            }
        }
        
        // ==================== NOTIFICATION FUNCTIONS ====================
        
        function updateNotificationCount() {
            const unreadCount = HRMSData.notifications.filter(n => !n.read).length;
            document.getElementById('notificationCount').textContent = unreadCount;
        }
        
        function openNotificationModal() {
            document.getElementById('notificationModal').classList.add('active');
            loadNotifications();
        }
        
        function closeNotificationModal() {
            document.getElementById('notificationModal').classList.remove('active');
        }
        
        function loadNotifications() {
            const notificationsList = document.getElementById('notificationsList');
            notificationsList.innerHTML = '';
            
            if (HRMSData.notifications.length === 0) {
                notificationsList.innerHTML = '<p style="text-align: center; padding: 20px;">No notifications</p>';
                return;
            }
            
            HRMSData.notifications.forEach(notification => {
                const notificationItem = document.createElement('div');
                notificationItem.className = 'notification-item';
                notificationItem.style.padding = '15px';
                notificationItem.style.borderBottom = '1px solid #f0f0f0';
                notificationItem.style.backgroundColor = notification.read ? 'white' : '#f8f9fa';
                
                notificationItem.innerHTML = `
                    <div style="font-weight: 600; color: var(--primary); margin-bottom: 5px;">
                        ${notification.title}
                        ${!notification.read ? '<span style="color: var(--accent); font-size: 10px; margin-left: 10px;">NEW</span>' : ''}
                    </div>
                    <div style="font-size: 14px; color: var(--gray); margin-bottom: 5px;">
                        ${notification.message}
                    </div>
                    <div style="font-size: 12px; color: var(--gray);">
                        ${formatDate(notification.date)}
                    </div>
                `;
                
                // Mark as read when clicked
                if (!notification.read) {
                    notificationItem.style.cursor = 'pointer';
                    notificationItem.addEventListener('click', function() {
                        notification.read = true;
                        updateNotificationCount();
                        loadNotifications();
                    });
                }
                
                notificationsList.appendChild(notificationItem);
            });
        }
        
        function markAllNotificationsAsRead() {
            HRMSData.notifications.forEach(notification => {
                notification.read = true;
            });
            updateNotificationCount();
            loadNotifications();
            alert('All notifications marked as read!');
        }
        
        function clearAllNotifications() {
            if (confirm('Are you sure you want to clear all notifications?')) {
                HRMSData.notifications = [];
                updateNotificationCount();
                loadNotifications();
            }
        }
        
        // ==================== REGULARIZATION FUNCTIONS ====================
        
        function openRegularizationModal() {
            document.getElementById('regularizationModal').classList.add('active');
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('regularizationDate').value = today;
        }
        
        function closeRegularizationModal() {
            document.getElementById('regularizationModal').classList.remove('active');
            document.getElementById('regularizationForm').reset();
        }
        
        function submitRegularizationRequest() {
            const date = document.getElementById('regularizationDate').value;
            const type = document.getElementById('regularizationType').value;
            const reason = document.getElementById('regularizationReason').value;
            
            if (!date || !type || !reason) {
                alert('Please fill in all required fields');
                return;
            }
            
            alert(`Regularization request submitted for ${formatDate(date)}\nType: ${type}\nReason: ${reason}`);
            
            // Close modal
            closeRegularizationModal();
            
            // In full implementation, this would send the request to the server
        }
        
        // ==================== SETTINGS FUNCTIONS ====================
        
        function changePassword() {
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (!currentPassword || !newPassword || !confirmPassword) {
                alert('Please fill in all password fields');
                return;
            }
            
            if (newPassword !== confirmPassword) {
                alert('New passwords do not match');
                return;
            }
            
            if (newPassword.length < 6) {
                alert('New password must be at least 6 characters long');
                return;
            }
            
            // In real app, verify current password with server
            alert('Password changed successfully!');
            
            // Clear fields
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmPassword').value = '';
        }
        
        function saveProfile() {
            // In real app, this would save profile changes to server
            alert('Profile saved successfully!');
        }
        
        // ==================== UTILITY FUNCTIONS ====================
        
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        }
        
        function formatDateShort(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        }
        
        // ==================== INITIALIZE APPLICATION ====================
        
        document.addEventListener('DOMContentLoaded', initHRMS);
    </script>
</body>
</html>