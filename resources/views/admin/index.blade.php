@extends('admin.layout.app')
@section('content')
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1 id="pageTitle">HRMS Dashboard</h1>
                <div class="header-info">
                    <div class="stats-card">
                        <div class="stats-icon icon-attendance">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stats-text">
                            <h3 id="todayAttendance">94%</h3>
                            <p>Attendance Today</p>
                        </div>
                    </div>
                    <div class="stats-card">
                        <div class="stats-icon icon-leave">
                            <i class="fas fa-umbrella-beach"></i>
                        </div>
                        <div class="stats-text">
                            <h3 id="onLeave">12</h3>
                            <p>On Leave</p>
                        </div>
                    </div>
                    <div class="stats-card">
                        <div class="stats-icon icon-payroll">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="stats-text">
                            <h3 id="pendingPayroll">28</h3>
                            <p>Payroll Pending</p>
                        </div>
                    </div>
                    <div class="stats-card">
                        <div class="stats-icon icon-staff">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-text">
                            <h3 id="totalStaff">{{$user}}</h3>
                            <p>Total Staff</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Module -->
            <div id="dashboard" class="module-content active">
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3>Today's Attendance Summary</h3>
                            <span id="todayDate">15 Oct 2023</span>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="attendanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3>Upcoming Holidays</h3>
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="card-body">
                            <div id="holidayCalendar"></div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3>Department Wise Headcount</h3>
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="departmentChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card" style="margin-top: 20px;">
                    <div class="card-header">
                        <h3>Recent Activities</h3>
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="card-body">
                        <div id="recentActivities">
                            <!-- Activities will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Employee Management Module -->
           
            
            <!-- Attendance & Shift Module -->
            
            
            <!-- Payroll Management Module -->
          
            
            <!-- Leave & Holiday Module -->
            
            <!-- Shift Roster Module -->
           
            
            <!-- Performance & KPI Module -->
            <div id="performance" class="module-content">
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3>Performance Dashboard</h3>
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="performanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3>Set KPI Targets</h3>
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div class="card-body">
                            <form id="kpiForm">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="kpiEmployee">Employee</label>
                                        <select id="kpiEmployee" class="form-control" required>
                                            <option value="">Select Employee</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kpiQuarter">Quarter</label>
                                        <select id="kpiQuarter" class="form-control" required>
                                            <option value="Q1">Q1 (Jan-Mar)</option>
                                            <option value="Q2">Q2 (Apr-Jun)</option>
                                            <option value="Q3">Q3 (Jul-Sep)</option>
                                            <option value="Q4">Q4 (Oct-Dec)</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="kpiTarget">Target Description</label>
                                    <textarea id="kpiTarget" class="form-control" rows="2" placeholder="Describe the KPI target..." required></textarea>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="kpiWeightage">Weightage (%)</label>
                                        <input type="number" id="kpiWeightage" class="form-control" min="1" max="100" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kpiDeadline">Deadline</label>
                                        <input type="date" id="kpiDeadline" class="form-control" required>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Set KPI</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="card" style="margin-top: 20px;">
                    <div class="card-header">
                        <h3>Employee Performance</h3>
                        <div>
                            <select id="performanceDepartmentFilter" class="form-control" style="width: auto; display: inline-block;">
                                <option value="">All Departments</option>
                                <option value="Retail">Retail</option>
                                <option value="Housekeeping">Housekeeping</option>
                                <option value="Security">Security</option>
                                <option value="Management">Management</option>
                            </select>
                            <button class="btn btn-primary" id="filterPerformanceBtn">Filter</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Attendance %</th>
                                    <th>Task Completion</th>
                                    <th>Customer Rating</th>
                                    <th>Overall Score</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="performanceTableBody">
                                <!-- Performance data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Task Management Module -->
           
            
            <!-- Reports & Analytics Module -->
            <div id="reports" class="module-content">
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <h3>Generate Report</h3>
                            <i class="fas fa-file-export"></i>
                        </div>
                        <div class="card-body">
                            <form id="reportForm">
                                <div class="form-group">
                                    <label for="reportType">Report Type</label>
                                    <select id="reportType" class="form-control">
                                        <option value="attendance">Attendance Report</option>
                                        <option value="payroll">Payroll Summary</option>
                                        <option value="leave">Leave Report</option>
                                        <option value="performance">Performance Report</option>
                                        <option value="manpower">Manpower Cost</option>
                                        <option value="attrition">Attrition Report</option>
                                    </select>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="reportPeriod">Period</label>
                                        <select id="reportPeriod" class="form-control">
                                            <option value="monthly">Monthly</option>
                                            <option value="quarterly">Quarterly</option>
                                            <option value="yearly">Yearly</option>
                                            <option value="custom">Custom Range</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="reportMonth">Month</label>
                                        <input type="month" id="reportMonth" class="form-control">
                                    </div>
                                </div>
                                
                                <div id="customDateRange" style="display: none;">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="reportFrom">From Date</label>
                                            <input type="date" id="reportFrom" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="reportTo">To Date</label>
                                            <input type="date" id="reportTo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="reportDepartment">Department (Optional)</label>
                                    <select id="reportDepartment" class="form-control">
                                        <option value="all">All Departments</option>
                                        <option value="Retail">Retail</option>
                                        <option value="Housekeeping">Housekeeping</option>
                                        <option value="Security">Security</option>
                                        <option value="Management">Management</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                                <button type="button" class="btn btn-success" id="exportReportBtn">Export to Excel</button>
                                <button type="button" class="btn btn-info" id="printReportBtn">Print Report</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3>Key Metrics</h3>
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-around; text-align: center; flex-wrap: wrap;">
                                <div style="margin: 15px;">
                                    <h3 style="color: var(--secondary-color);" id="avgAttendance">94%</h3>
                                    <p>Avg. Attendance</p>
                                </div>
                                <div style="margin: 15px;">
                                    <h3 style="color: var(--success-color);" id="productivityIncrease">12.5%</h3>
                                    <p>Productivity Increase</p>
                                </div>
                                <div style="margin: 15px;">
                                    <h3 style="color: var(--warning-color);" id="attritionRate">8.2%</h3>
                                    <p>Attrition Rate</p>
                                </div>
                                <div style="margin: 15px;">
                                    <h3 style="color: var(--accent-color);" id="monthlyPayroll">₹18.2L</h3>
                                    <p>Monthly Payroll Cost</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card" style="margin-top: 20px;">
                    <div class="card-header">
                        <h3>Report Output</h3>
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-body">
                        <div id="reportOutput">
                            <!-- Report will be displayed here -->
                            <div class="no-data">
                                <i class="fas fa-file-alt"></i>
                                <h3>No Report Generated Yet</h3>
                                <p>Select parameters and generate a report to see the output here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection