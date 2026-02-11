@extends('admin.layout.app')

@section('content')
    <div class="main-content">
       <div id="reports" class="">
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
    @endsection
