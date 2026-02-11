  <script>
        // ========== DATA STORAGE ==========
        // Comprehensive sample data for all modules
        let employees = [
            {id: "EMP001", firstName: "Rajesh", lastName: "Kumar", email: "rajesh.kumar@mallhrms.com", phone: "+91 9876543210", department: "Retail", role: "Cashier", store: "Store #12", shift: "Morning", joinDate: "2023-01-15", salary: 18000, address: "123 Mall Street, City, State 123456", status: "Active"},
            {id: "EMP002", firstName: "Priya", lastName: "Sharma", email: "priya.sharma@mallhrms.com", phone: "+91 9876543211", department: "Housekeeping", role: "Cleaner", store: "Floor 2", shift: "Morning", joinDate: "2023-02-20", salary: 16000, address: "456 Clean Avenue, City, State 123456", status: "Active"},
            {id: "EMP003", firstName: "Amit", lastName: "Patel", email: "amit.patel@mallhrms.com", phone: "+91 9876543212", department: "Security", role: "Security Guard", store: "Main Gate", shift: "Night", joinDate: "2023-03-10", salary: 17000, address: "789 Security Road, City, State 123456", status: "Active"},
            {id: "EMP004", firstName: "Sneha", lastName: "Verma", email: "sneha.verma@mallhrms.com", phone: "+91 9876543213", department: "Retail", role: "Store Manager", store: "Store #08", shift: "Evening", joinDate: "2022-11-05", salary: 25000, address: "101 Manager Lane, City, State 123456", status: "Active"},
            {id: "EMP005", firstName: "Vikram", lastName: "Singh", email: "vikram.singh@mallhrms.com", phone: "+91 9876543214", department: "Management", role: "HR Executive", store: "Admin Block", shift: "Morning", joinDate: "2022-09-12", salary: 30000, address: "202 Admin Boulevard, City, State 123456", status: "Active"},
            {id: "EMP006", firstName: "Anita", lastName: "Desai", email: "anita.desai@mallhrms.com", phone: "+91 9876543215", department: "Retail", role: "Cashier", store: "Store #05", shift: "Morning", joinDate: "2023-04-18", salary: 18000, address: "303 Retail Road, City, State 123456", status: "On Leave"},
            {id: "EMP007", firstName: "Rohan", lastName: "Mehta", email: "rohan.mehta@mallhrms.com", phone: "+91 9876543216", department: "Security", role: "Security Supervisor", store: "Parking Area", shift: "Evening", joinDate: "2022-12-03", salary: 22000, address: "404 Patrol Path, City, State 123456", status: "Active"},
            {id: "EMP008", firstName: "Kavita", lastName: "Reddy", email: "kavita.reddy@mallhrms.com", phone: "+91 9876543217", department: "Housekeeping", role: "Supervisor", store: "Food Court", shift: "Morning", joinDate: "2023-05-22", salary: 19000, address: "505 Hygiene Street, City, State 123456", status: "Active"},
            {id: "EMP009", firstName: "Arun", lastName: "Joshi", email: "arun.joshi@mallhrms.com", phone: "+91 9876543218", department: "Maintenance", role: "Technician", store: "Maintenance Dept", shift: "Flexible", joinDate: "2023-06-30", salary: 20000, address: "606 Repair Road, City, State 123456", status: "Active"},
            {id: "EMP010", firstName: "Meera", lastName: "Nair", email: "meera.nair@mallhrms.com", phone: "+91 9876543219", department: "Food Court", role: "Food Server", store: "Food Court", shift: "Evening", joinDate: "2023-07-14", salary: 16500, address: "707 Food Lane, City, State 123456", status: "Probation"}
        ];

        let attendanceRecords = [
            {id: "ATT001", employeeId: "EMP001", date: "2023-10-15", checkIn: "09:05", checkOut: "18:10", status: "Present", hours: 9.1, remarks: "On time"},
            {id: "ATT002", employeeId: "EMP002", date: "2023-10-15", checkIn: "08:55", checkOut: "17:58", status: "Present", hours: 9.0, remarks: ""},
            {id: "ATT003", employeeId: "EMP003", date: "2023-10-15", checkIn: "20:10", checkOut: "06:15", status: "Present", hours: 10.1, remarks: "Night shift"},
            {id: "ATT004", employeeId: "EMP004", date: "2023-10-15", checkIn: "14:00", checkOut: "22:05", status: "Present", hours: 8.1, remarks: ""},
            {id: "ATT005", employeeId: "EMP005", date: "2023-10-15", checkIn: "09:30", checkOut: "18:30", status: "Late", hours: 9.0, remarks: "Late by 30 mins"},
            {id: "ATT006", employeeId: "EMP006", date: "2023-10-15", checkIn: "", checkOut: "", status: "Absent", hours: 0, remarks: "On leave"},
            {id: "ATT007", employeeId: "EMP007", date: "2023-10-15", checkIn: "13:55", checkOut: "22:00", status: "Present", hours: 8.1, remarks: ""},
            {id: "ATT008", employeeId: "EMP008", date: "2023-10-15", checkIn: "08:50", checkOut: "17:55", status: "Present", hours: 9.1, remarks: ""}
        ];

        let payrollRecords = [
            {id: "PAY001", employeeId: "EMP001", month: "2023-10", basicSalary: 18000, allowances: 2000, deductions: 1500, netSalary: 18500, status: "Processed", paymentDate: "2023-10-05"},
            {id: "PAY002", employeeId: "EMP002", month: "2023-10", basicSalary: 16000, allowances: 1500, deductions: 1200, netSalary: 16300, status: "Processed", paymentDate: "2023-10-05"},
            {id: "PAY003", employeeId: "EMP003", month: "2023-10", basicSalary: 17000, allowances: 2500, deductions: 1400, netSalary: 18100, status: "Pending", paymentDate: ""},
            {id: "PAY004", employeeId: "EMP004", month: "2023-10", basicSalary: 25000, allowances: 5000, deductions: 3000, netSalary: 27000, status: "Processed", paymentDate: "2023-10-05"},
            {id: "PAY005", employeeId: "EMP005", month: "2023-10", basicSalary: 30000, allowances: 8000, deductions: 4500, netSalary: 33500, status: "Pending", paymentDate: ""},
            {id: "PAY006", employeeId: "EMP006", month: "2023-10", basicSalary: 18000, allowances: 2000, deductions: 1500, netSalary: 18500, status: "On Hold", paymentDate: ""},
            {id: "PAY007", employeeId: "EMP007", month: "2023-10", basicSalary: 22000, allowances: 3000, deductions: 2000, netSalary: 23000, status: "Processed", paymentDate: "2023-10-05"},
            {id: "PAY008", employeeId: "EMP008", month: "2023-10", basicSalary: 19000, allowances: 2500, deductions: 1600, netSalary: 19900, status: "Pending", paymentDate: ""}
        ];

        let leaveRecords = [
            {id: "LEV001", employeeId: "EMP001", type: "Sick Leave", fromDate: "2023-10-12", toDate: "2023-10-13", duration: 2, reason: "Fever and cold", contact: "+91 9876543210", status: "Approved", appliedDate: "2023-10-10"},
            {id: "LEV002", employeeId: "EMP002", type: "Casual Leave", fromDate: "2023-10-15", toDate: "2023-10-15", duration: 1, reason: "Personal work", contact: "+91 9876543211", status: "Pending", appliedDate: "2023-10-11"},
            {id: "LEV003", employeeId: "EMP003", type: "Earned Leave", fromDate: "2023-10-20", toDate: "2023-10-22", duration: 3, reason: "Family function", contact: "+91 9876543212", status: "Pending", appliedDate: "2023-10-12"},
            {id: "LEV004", employeeId: "EMP004", type: "Casual Leave", fromDate: "2023-10-11", toDate: "2023-10-11", duration: 1, reason: "Doctor appointment", contact: "+91 9876543213", status: "Approved", appliedDate: "2023-10-09"},
            {id: "LEV005", employeeId: "EMP005", type: "Sick Leave", fromDate: "2023-10-14", toDate: "2023-10-14", duration: 1, reason: "Not feeling well", contact: "+91 9876543214", status: "Rejected", appliedDate: "2023-10-13"},
            {id: "LEV006", employeeId: "EMP006", type: "Maternity Leave", fromDate: "2023-10-10", toDate: "2024-01-10", duration: 92, reason: "Maternity", contact: "+91 9876543215", status: "Approved", appliedDate: "2023-10-01"}
        ];

        let holidays = [
            {id: "HOL001", name: "Diwali", date: "2023-10-24", type: "Festival", description: "Festival of Lights"},
            {id: "HOL002", name: "Govardhan Puja", date: "2023-10-25", type: "Festival", description: "Govardhan Puja Celebration"},
            {id: "HOL003", name: "Christmas", date: "2023-12-25", type: "Festival", description: "Christmas Celebration"},
            {id: "HOL004", name: "New Year", date: "2024-01-01", type: "Public Holiday", description: "New Year Day"},
            {id: "HOL005", name: "Republic Day", date: "2024-01-26", type: "National Holiday", description: "Republic Day"},
            {id: "HOL006", name: "Holi", date: "2024-03-25", type: "Festival", description: "Festival of Colors"}
        ];

        let shiftRosters = [
            {id: "ROS001", employeeId: "EMP001", week: "2023-W42", mon: "Morning", tue: "Morning", wed: "Morning", thu: "Morning", fri: "Morning", sat: "Evening", sun: "Off", totalHours: 48},
            {id: "ROS002", employeeId: "EMP002", week: "2023-W42", mon: "Morning", tue: "Morning", wed: "Morning", thu: "Evening", fri: "Evening", sat: "Off", sun: "Morning", totalHours: 40},
            {id: "ROS003", employeeId: "EMP003", week: "2023-W42", mon: "Night", tue: "Night", wed: "Off", thu: "Night", fri: "Night", sat: "Night", sun: "Off", totalHours: 48},
            {id: "ROS004", employeeId: "EMP004", week: "2023-W42", mon: "Evening", tue: "Evening", wed: "Evening", thu: "Evening", fri: "Evening", sat: "Off", sun: "Off", totalHours: 40},
            {id: "ROS005", employeeId: "EMP005", week: "2023-W42", mon: "Morning", tue: "Morning", wed: "Morning", thu: "Morning", fri: "Morning", sat: "Off", sun: "Off", totalHours: 40}
        ];

        let performanceRecords = [
            {id: "PER001", employeeId: "EMP001", quarter: "Q4-2023", attendance: 96, taskCompletion: 92, customerRating: 4.5, overallScore: 94, rating: "Excellent", feedback: "Excellent performance"},
            {id: "PER002", employeeId: "EMP002", quarter: "Q4-2023", attendance: 98, taskCompletion: 95, customerRating: 4.8, overallScore: 97, rating: "Excellent", feedback: "Very dedicated"},
            {id: "PER003", employeeId: "EMP003", quarter: "Q4-2023", attendance: 94, taskCompletion: 88, customerRating: 4.2, overallScore: 89, rating: "Good", feedback: "Good performance"},
            {id: "PER004", employeeId: "EMP004", quarter: "Q4-2023", attendance: 92, taskCompletion: 96, customerRating: 4.7, overallScore: 95, rating: "Excellent", feedback: "Great leadership"},
            {id: "PER005", employeeId: "EMP005", quarter: "Q4-2023", attendance: 90, taskCompletion: 94, customerRating: 4.4, overallScore: 93, rating: "Good", feedback: "Good management"},
            {id: "PER006", employeeId: "EMP006", quarter: "Q4-2023", attendance: 85, taskCompletion: 82, customerRating: 3.9, overallScore: 84, rating: "Average", feedback: "Needs improvement"},
            {id: "PER007", employeeId: "EMP007", quarter: "Q4-2023", attendance: 97, taskCompletion: 90, customerRating: 4.6, overallScore: 94, rating: "Excellent", feedback: "Very reliable"},
            {id: "PER008", employeeId: "EMP008", quarter: "Q4-2023", attendance: 95, taskCompletion: 93, customerRating: 4.5, overallScore: 94, rating: "Excellent", feedback: "Consistent performer"}
        ];

        let kpiRecords = [
            {id: "KPI001", employeeId: "EMP001", quarter: "Q4-2023", target: "Increase customer satisfaction score by 10%", weightage: 30, deadline: "2023-12-31", status: "In Progress", achievement: 65},
            {id: "KPI002", employeeId: "EMP002", quarter: "Q4-2023", target: "Reduce cleaning time by 15%", weightage: 25, deadline: "2023-12-31", status: "Completed", achievement: 100},
            {id: "KPI003", employeeId: "EMP004", quarter: "Q4-2023", target: "Increase store sales by 20%", weightage: 40, deadline: "2023-12-31", status: "In Progress", achievement: 75}
        ];

        let tasks = [
            {id: "TASK001", title: "Floor cleaning - Level 3", assigneeId: "EMP002", priority: "High", startDate: "2023-10-14", dueDate: "2023-10-15", status: "Pending", progress: 0, description: "Complete cleaning of level 3 including washrooms"},
            {id: "TASK002", title: "Cash counting - Store #12", assigneeId: "EMP001", priority: "Medium", startDate: "2023-10-14", dueDate: "2023-10-14", status: "Completed", progress: 100, description: "Daily cash counting and deposit"},
            {id: "TASK003", title: "Security patrol - Parking area", assigneeId: "EMP003", priority: "Medium", startDate: "2023-10-15", dueDate: "2023-10-15", status: "In Progress", progress: 60, description: "Night patrol in parking area"},
            {id: "TASK004", title: "Stock audit - Store #08", assigneeId: "EMP004", priority: "High", startDate: "2023-10-16", dueDate: "2023-10-16", status: "Pending", progress: 0, description: "Monthly stock audit and verification"},
            {id: "TASK005", title: "Employee training session", assigneeId: "EMP005", priority: "Low", startDate: "2023-10-18", dueDate: "2023-10-18", status: "Pending", progress: 0, description: "Training on new HR policies"},
            {id: "TASK006", title: "Fire safety check", assigneeId: "EMP007", priority: "High", startDate: "2023-10-17", dueDate: "2023-10-17", status: "Pending", progress: 0, description: "Monthly fire safety equipment check"},
            {id: "TASK007", title: "Customer feedback analysis", assigneeId: "EMP001", priority: "Medium", startDate: "2023-10-20", dueDate: "2023-10-25", status: "Pending", progress: 0, description: "Analyze customer feedback for Q3"},
            {id: "TASK008", title: "Maintenance - Escalator 2", assigneeId: "EMP009", priority: "High", startDate: "2023-10-16", dueDate: "2023-10-19", status: "In Progress", progress: 30, description: "Repair and maintenance of escalator 2"}
        ];

        // ========== GLOBAL VARIABLES ==========
        let currentPage = 1;
        const itemsPerPage = 5;
        let charts = {};
        
        // ========== ROLE CONFIGURATION ==========
        const roleConfig = {
            hr: {name: "HR Manager", avatar: "AM", fullName: "Anjali Mehta", modules: ["dashboard", "employee", "attendance", "payroll", "leave", "roster", "performance", "task", "reports"]},
            store: {name: "Store Manager", avatar: "SM", fullName: "Sneha Verma", modules: ["dashboard", "employee", "attendance", "leave", "roster", "performance", "task"]},
            supervisor: {name: "Supervisor", avatar: "RS", fullName: "Rohan Mehta", modules: ["dashboard", "attendance", "leave", "task"]},
            finance: {name: "Finance/Admin", avatar: "VS", fullName: "Vikram Singh", modules: ["dashboard", "payroll", "reports"]},
            employee: {name: "Employee", avatar: "RK", fullName: "Rajesh Kumar", modules: ["dashboard", "attendance", "leave", "task"]}
        };

        // ========== INITIALIZATION ==========
        document.addEventListener('DOMContentLoaded', function() {
            // Set today's date
            const today = new Date();
            document.getElementById('todayDate').textContent = formatDate(today);
            document.getElementById('attendanceDate').value = today.toISOString().split('T')[0];
            document.getElementById('attendanceReportDate').value = today.toISOString().split('T')[0];
            document.getElementById('leaveFrom').value = today.toISOString().split('T')[0];
            document.getElementById('leaveTo').value = today.toISOString().split('T')[0];
            document.getElementById('taskDueDate').value = today.toISOString().split('T')[0];
            document.getElementById('taskStartDate').value = today.toISOString().split('T')[0];
            document.getElementById('joinDate').value = today.toISOString().split('T')[0];
            
            // Set current month for payroll
            const currentMonth = today.toISOString().substring(0, 7);
            document.getElementById('payrollMonth').value = currentMonth;
            document.getElementById('payrollFilterMonth').value = currentMonth;
            document.getElementById('reportMonth').value = currentMonth;
            
            // Set current week for roster
            const currentWeek = getWeekNumber(today);
            document.getElementById('rosterWeek').value = currentWeek;
            document.getElementById('viewRosterWeek').value = currentWeek;
            
            // Initialize application
            changeRole('hr');
            loadAllData();
            setupEventListeners();
            initializeCharts();
            updateDashboardStats();
        });

        // ========== EVENT LISTENERS SETUP ==========
        function setupEventListeners() {
            // Navigation
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                    const moduleId = this.getAttribute('data-module');
                    document.getElementById('pageTitle').textContent = this.querySelector('span').textContent;
                    showModule(moduleId);
                });
            });

            // Role selector
            document.getElementById('roleSelect').addEventListener('change', function() {
                changeRole(this.value);
            });

            // Employee Management
            document.getElementById('addEmployeeBtn').addEventListener('click', openAddEmployeeModal);
            document.getElementById('closeModal').addEventListener('click', closeEmployeeModal);
            document.getElementById('cancelBtn').addEventListener('click', closeEmployeeModal);
            document.getElementById('resetBtn').addEventListener('click', resetEmployeeForm);
            document.getElementById('employeeForm').addEventListener('submit', handleEmployeeSubmit);
            document.getElementById('employeeSearch').addEventListener('input', filterEmployees);
            document.getElementById('departmentFilter').addEventListener('change', filterEmployees);
            document.getElementById('statusFilter').addEventListener('change', filterEmployees);
            document.getElementById('sortBy').addEventListener('change', filterEmployees);

            // Attendance
            document.getElementById('markAttendanceForm').addEventListener('submit', markAttendance);
            document.getElementById('generateAttendanceReport').addEventListener('click', generateAttendanceReport);
            document.getElementById('exportAttendanceBtn').addEventListener('click', exportAttendanceReport);

            // Payroll
            document.getElementById('processPayrollForm').addEventListener('submit', processPayroll);
            document.getElementById('generatePayslipsBtn').addEventListener('click', generatePayslips);
            document.getElementById('filterPayrollBtn').addEventListener('click', filterPayroll);

            // Leave
            document.getElementById('leaveForm').addEventListener('submit', applyLeave);
            document.getElementById('leaveFrom').addEventListener('change', calculateLeaveDuration);
            document.getElementById('leaveTo').addEventListener('change', calculateLeaveDuration);
            document.getElementById('leaveStatusFilter').addEventListener('change', filterLeaveApplications);
            document.getElementById('leaveTypeFilter').addEventListener('change', filterLeaveApplications);

            // Roster
            document.getElementById('rosterForm').addEventListener('submit', generateRoster);
            document.getElementById('publishRosterBtn').addEventListener('click', publishRoster);
            document.getElementById('loadRosterBtn').addEventListener('click', loadRoster);
            document.getElementById('printRosterBtn').addEventListener('click', printRoster);

            // Performance
            document.getElementById('kpiForm').addEventListener('submit', setKPI);
            document.getElementById('filterPerformanceBtn').addEventListener('click', filterPerformance);

            // Task Management
            document.getElementById('taskForm').addEventListener('submit', createTask);
            document.getElementById('filterTaskBtn').addEventListener('click', filterTasks);
            document.getElementById('taskStatusFilter').addEventListener('change', filterTasks);
            document.getElementById('taskPriorityFilter').addEventListener('change', filterTasks);

            // Reports
            document.getElementById('reportForm').addEventListener('submit', generateReport);
            document.getElementById('exportReportBtn').addEventListener('click', exportReport);
            document.getElementById('printReportBtn').addEventListener('click', printReport);
            document.getElementById('reportPeriod').addEventListener('change', function() {
                document.getElementById('customDateRange').style.display = 
                    this.value === 'custom' ? 'block' : 'none';
            });
        }

        // ========== CORE FUNCTIONS ==========
        function changeRole(roleKey) {
            const role = roleConfig[roleKey];
            
            // Update user display
            document.getElementById('currentUserAvatar').textContent = role.avatar;
            document.getElementById('currentUserName').textContent = role.fullName;
            document.getElementById('currentUserRole').textContent = role.name;
            
            // Update role selector
            document.getElementById('roleSelect').value = roleKey;
            
            // Hide all modules
            document.querySelectorAll('.module-content').forEach(module => module.classList.remove('active'));
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            
            // Show accessible modules
            role.modules.forEach(moduleId => {
                const module = document.getElementById(moduleId);
                if (module) module.classList.add('active');
                
                if (moduleId === role.modules[0]) {
                    const navLink = document.querySelector(`[data-module="${moduleId}"]`);
                    if (navLink) {
                        navLink.classList.add('active');
                        document.getElementById('pageTitle').textContent = navLink.querySelector('span').textContent;
                    }
                }
            });
            
            // Show dashboard by default
            if (role.modules.includes('dashboard')) {
                document.getElementById('dashboard').classList.add('active');
                const dashboardLink = document.querySelector('[data-module="dashboard"]');
                dashboardLink.classList.add('active');
                document.getElementById('pageTitle').textContent = 'HRMS Dashboard';
            }
        }

        function showModule(moduleId) {
            document.querySelectorAll('.module-content').forEach(module => module.classList.remove('active'));
            const selectedModule = document.getElementById(moduleId);
            if (selectedModule) selectedModule.classList.add('active');
            
            // Refresh module data
            switch(moduleId) {
                case 'employee':
                    loadEmployeeData();
                    break;
                case 'attendance':
                    loadAttendanceData();
                    break;
                case 'payroll':
                    loadPayrollData();
                    break;
                case 'leave':
                    loadLeaveData();
                    break;
                case 'roster':
                    loadRosterData();
                    break;
                case 'performance':
                    loadPerformanceData();
                    break;
                case 'task':
                    loadTaskData();
                    break;
            }
        }

        // ========== DASHBOARD FUNCTIONS ==========
        function updateDashboardStats() {
            // Calculate today's attendance
            const today = new Date().toISOString().split('T')[0];
            const todayAttendance = attendanceRecords.filter(a => a.date === today);
            const presentCount = todayAttendance.filter(a => a.status === 'Present' || a.status === 'Late').length;
            const totalCount = todayAttendance.length;
            const attendancePercentage = totalCount > 0 ? Math.round((presentCount / totalCount) * 100) : 0;
            
            document.getElementById('todayAttendance').textContent = attendancePercentage + '%';
            document.getElementById('onLeave').textContent = employees.filter(e => e.status === 'On Leave').length;
            document.getElementById('pendingPayroll').textContent = payrollRecords.filter(p => p.status === 'Pending').length;
            document.getElementById('totalStaff').textContent = employees.length;
            
            // Update recent activities
            updateRecentActivities();
        }

        function updateRecentActivities() {
            const activities = [
                {time: "10:30 AM", activity: "Rajesh Kumar marked attendance", type: "attendance"},
                {time: "09:45 AM", activity: "New employee Meera Nair joined", type: "employee"},
                {time: "Yesterday", activity: "Payroll processed for 15 employees", type: "payroll"},
                {time: "2 days ago", activity: "Diwali holiday announced", type: "holiday"},
                {time: "3 days ago", activity: "Monthly performance review completed", type: "performance"}
            ];
            
            const container = document.getElementById('recentActivities');
            container.innerHTML = activities.map(a => `
                <div class="employee-item">
                    <div class="employee-avatar" style="background-color: ${getActivityColor(a.type)}">
                        <i class="fas ${getActivityIcon(a.type)}"></i>
                    </div>
                    <div class="employee-info">
                        <h4>${a.activity}</h4>
                        <p>${a.time}</p>
                    </div>
                </div>
            `).join('');
        }

        function getActivityColor(type) {
            const colors = {
                attendance: '#3498db',
                employee: '#2ecc71',
                payroll: '#9b59b6',
                holiday: '#e74c3c',
                performance: '#f39c12'
            };
            return colors[type] || '#95a5a6';
        }

        function getActivityIcon(type) {
            const icons = {
                attendance: 'fa-calendar-check',
                employee: 'fa-user-plus',
                payroll: 'fa-money-check-alt',
                holiday: 'fa-umbrella-beach',
                performance: 'fa-chart-line'
            };
            return icons[type] || 'fa-bell';
        }

        function initializeCharts() {
            // Attendance Chart
            const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
            charts.attendance = new Chart(attendanceCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Present', 'Absent', 'Late', 'Half Day'],
                    datasets: [{
                        data: [245, 8, 7, 3],
                        backgroundColor: ['#28a745', '#dc3545', '#ffc107', '#17a2b8'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Department Chart
            const departmentCtx = document.getElementById('departmentChart').getContext('2d');
            charts.department = new Chart(departmentCtx, {
                type: 'pie',
                data: {
                    labels: ['Retail', 'Housekeeping', 'Security', 'Management', 'Others'],
                    datasets: [{
                        data: [120, 85, 55, 20, 15],
                        backgroundColor: ['#3498db', '#2ecc71', '#e74c3c', '#9b59b6', '#f39c12'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Shift Chart
            const shiftCtx = document.getElementById('shiftChart').getContext('2d');
            charts.shift = new Chart(shiftCtx, {
                type: 'bar',
                data: {
                    labels: ['Morning', 'Evening', 'Night'],
                    datasets: [{
                        label: 'Number of Employees',
                        data: [120, 85, 55],
                        backgroundColor: ['#3498db', '#9b59b6', '#2ecc71'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Performance Chart
            const performanceCtx = document.getElementById('performanceChart').getContext('2d');
            charts.performance = new Chart(performanceCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                    datasets: [{
                        label: 'Average Performance Score',
                        data: [85, 87, 89, 88, 90, 92, 91, 93, 94, 95],
                        borderColor: '#3498db',
                        backgroundColor: 'rgba(52, 152, 219, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            min: 70,
                            max: 100
                        }
                    }
                }
            });

            // Task Chart
            const taskCtx = document.getElementById('taskChart').getContext('2d');
            charts.task = new Chart(taskCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'In Progress', 'Pending', 'Overdue'],
                    datasets: [{
                        data: [1, 2, 5, 0],
                        backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Roster Chart
            const rosterCtx = document.getElementById('rosterChart').getContext('2d');
            charts.roster = new Chart(rosterCtx, {
                type: 'pie',
                data: {
                    labels: ['Morning', 'Evening', 'Night', 'Off'],
                    datasets: [{
                        data: [35, 25, 15, 25],
                        backgroundColor: ['#3498db', '#9b59b6', '#2ecc71', '#95a5a6'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // ========== EMPLOYEE MANAGEMENT ==========
        function loadAllData() {
            loadEmployeeData();
            loadAttendanceData();
            loadPayrollData();
            loadLeaveData();
            loadRosterData();
            loadPerformanceData();
            loadTaskData();
            loadHolidays();
        }

        function loadEmployeeData() {
            const searchTerm = document.getElementById('employeeSearch').value.toLowerCase();
            const department = document.getElementById('departmentFilter').value;
            const status = document.getElementById('statusFilter').value;
            const sortValue = document.getElementById('sortBy').value;
            
            let filteredEmployees = employees.filter(emp => {
                const fullName = `${emp.firstName} ${emp.lastName}`.toLowerCase();
                const matchesSearch = searchTerm === '' || 
                    fullName.includes(searchTerm) ||
                    emp.id.toLowerCase().includes(searchTerm) ||
                    emp.department.toLowerCase().includes(searchTerm) ||
                    emp.role.toLowerCase().includes(searchTerm) ||
                    emp.store.toLowerCase().includes(searchTerm);
                
                const matchesDept = !department || emp.department === department;
                const matchesStatus = !status || emp.status === status;
                
                return matchesSearch && matchesDept && matchesStatus;
            });
            
            filteredEmployees.sort((a, b) => {
                switch(sortValue) {
                    case 'name':
                        return `${a.firstName} ${a.lastName}`.localeCompare(`${b.firstName} ${b.lastName}`);
                    case 'name-desc':
                        return `${b.firstName} ${b.lastName}`.localeCompare(`${a.firstName} ${a.lastName}`);
                    case 'department':
                        return a.department.localeCompare(b.department);
                    case 'date':
                        return new Date(b.joinDate) - new Date(a.joinDate);
                    case 'date-old':
                        return new Date(a.joinDate) - new Date(b.joinDate);
                    default:
                        return 0;
                }
            });
            
            updatePagination('employee', filteredEmployees.length);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentEmployees = filteredEmployees.slice(startIndex, endIndex);
            
            renderEmployeeTable(currentEmployees);
            
            // Update dropdowns
            updateEmployeeDropdowns();
        }

        function renderEmployeeTable(employeesToRender) {
            const tbody = document.getElementById('employeeTableBody');
            tbody.innerHTML = '';
            
            if (employeesToRender.length === 0) {
                document.getElementById('noEmployeesMessage').style.display = 'block';
                tbody.style.display = 'none';
                document.getElementById('employeePagination').style.display = 'none';
                return;
            }
            
            document.getElementById('noEmployeesMessage').style.display = 'none';
            tbody.style.display = 'table-row-group';
            document.getElementById('employeePagination').style.display = 'flex';
            
            employeesToRender.forEach(emp => {
                const row = document.createElement('tr');
                const avatar = emp.firstName.charAt(0) + emp.lastName.charAt(0);
                const colors = ['#3498db', '#e74c3c', '#2ecc71', '#9b59b6', '#f39c12', '#1abc9c', '#34495e', '#d35400'];
                const colorIndex = (emp.firstName.charCodeAt(0) + emp.lastName.charCodeAt(0)) % colors.length;
                const avatarColor = colors[colorIndex];
                
                let statusColor, statusTextColor;
                switch(emp.status) {
                    case 'Active':
                        statusColor = '#d4edda';
                        statusTextColor = '#155724';
                        break;
                    case 'On Leave':
                        statusColor = '#cce5ff';
                        statusTextColor = '#004085';
                        break;
                    case 'Probation':
                        statusColor = '#fff3cd';
                        statusTextColor = '#856404';
                        break;
                    case 'Inactive':
                        statusColor = '#f8d7da';
                        statusTextColor = '#721c24';
                        break;
                    default:
                        statusColor = '#e2e3e5';
                        statusTextColor = '#383d41';
                }
                
                row.innerHTML = `
                    <td>${emp.id}</td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <div class="employee-avatar" style="background-color: ${avatarColor}; margin-right: 10px;">${avatar}</div>
                            <div>
                                <div style="font-weight: 600;">${emp.firstName} ${emp.lastName}</div>
                                <div style="font-size: 0.8rem; color: #666;">${emp.email}</div>
                            </div>
                        </div>
                    </td>
                    <td>${emp.department}</td>
                    <td>${emp.store}</td>
                    <td>${emp.role}</td>
                    <td>
                        <span style="padding: 3px 8px; border-radius: 20px; background-color: ${statusColor}; color: ${statusTextColor}; font-size: 0.8rem;">
                            ${emp.status}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm view-employee" data-id="${emp.id}" style="margin-right: 5px;">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-warning btn-sm edit-employee" data-id="${emp.id}" style="margin-right: 5px;">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-employee" data-id="${emp.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            // Add event listeners
            document.querySelectorAll('.view-employee').forEach(btn => {
                btn.addEventListener('click', function() {
                    viewEmployeeDetails(this.getAttribute('data-id'));
                });
            });
            
            document.querySelectorAll('.edit-employee').forEach(btn => {
                btn.addEventListener('click', function() {
                    editEmployee(this.getAttribute('data-id'));
                });
            });
            
            document.querySelectorAll('.delete-employee').forEach(btn => {
                btn.addEventListener('click', function() {
                    confirmDeleteEmployee(this.getAttribute('data-id'));
                });
            });
        }

        function updateEmployeeDropdowns() {
            const dropdowns = [
                'attendanceEmployee',
                'taskAssignee',
                'kpiEmployee'
            ];
            
            dropdowns.forEach(dropdownId => {
                const dropdown = document.getElementById(dropdownId);
                if (dropdown) {
                    dropdown.innerHTML = '<option value="">Select Employee</option>' +
                        employees.map(emp => 
                            `<option value="${emp.id}">${emp.firstName} ${emp.lastName} (${emp.department})</option>`
                        ).join('');
                }
            });
        }

        function openAddEmployeeModal() {
            document.getElementById('modalTitle').textContent = 'Add New Employee';
            document.getElementById('submitBtn').textContent = 'Add Employee';
            document.getElementById('employeeForm').reset();
            document.getElementById('employeeId').value = '';
            document.getElementById('joinDate').value = new Date().toISOString().split('T')[0];
            document.getElementById('status').value = 'Active';
            document.getElementById('employeeModal').style.display = 'block';
        }

        function handleEmployeeSubmit(e) {
            e.preventDefault();
            
            const employeeId = document.getElementById('employeeId').value;
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const department = document.getElementById('department').value;
            const role = document.getElementById('role').value.trim();
            const store = document.getElementById('store').value.trim();
            const shift = document.getElementById('shift').value;
            const joinDate = document.getElementById('joinDate').value;
            const salary = document.getElementById('salary').value ? parseInt(document.getElementById('salary').value) : 0;
            const address = document.getElementById('address').value.trim();
            const status = document.getElementById('status').value;
            
            if (!firstName || !lastName || !email || !phone || !department || !role || !store || !joinDate || !status) {
                alert('Please fill in all required fields.');
                return;
            }
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            
            if (employeeId) {
                // Update
                const index = employees.findIndex(emp => emp.id === employeeId);
                if (index !== -1) {
                    employees[index] = {
                        ...employees[index],
                        firstName,
                        lastName,
                        email,
                        phone,
                        department,
                        role,
                        store,
                        shift,
                        joinDate,
                        salary,
                        address,
                        status
                    };
                    alert('Employee updated successfully!');
                }
            } else {
                // Add new
                const newId = generateId('EMP');
                const newEmployee = {
                    id: newId,
                    firstName,
                    lastName,
                    email,
                    phone,
                    department,
                    role,
                    store,
                    shift,
                    joinDate,
                    salary,
                    address,
                    status
                };
                employees.unshift(newEmployee);
                alert('Employee added successfully!');
            }
            
            closeEmployeeModal();
            loadEmployeeData();
            updateDashboardStats();
        }

        function editEmployee(id) {
            const employee = employees.find(emp => emp.id === id);
            if (employee) {
                document.getElementById('modalTitle').textContent = 'Edit Employee';
                document.getElementById('submitBtn').textContent = 'Update Employee';
                document.getElementById('employeeId').value = employee.id;
                document.getElementById('firstName').value = employee.firstName;
                document.getElementById('lastName').value = employee.lastName;
                document.getElementById('email').value = employee.email;
                document.getElementById('phone').value = employee.phone;
                document.getElementById('department').value = employee.department;
                document.getElementById('role').value = employee.role;
                document.getElementById('store').value = employee.store;
                document.getElementById('shift').value = employee.shift;
                document.getElementById('joinDate').value = employee.joinDate;
                document.getElementById('salary').value = employee.salary;
                document.getElementById('address').value = employee.address;
                document.getElementById('status').value = employee.status;
                document.getElementById('employeeModal').style.display = 'block';
            }
        }

        function confirmDeleteEmployee(id) {
            const employee = employees.find(emp => emp.id === id);
            if (!employee) return;
            
            if (confirm(`Are you sure you want to delete ${employee.firstName} ${employee.lastName}? This action cannot be undone.`)) {
                employees = employees.filter(emp => emp.id !== id);
                alert('Employee deleted successfully!');
                loadEmployeeData();
                updateDashboardStats();
            }
        }

        // ========== ATTENDANCE MANAGEMENT ==========
        function loadAttendanceData() {
            const date = document.getElementById('attendanceReportDate').value;
            const filteredRecords = attendanceRecords.filter(record => record.date === date);
            
            const tbody = document.getElementById('attendanceTableBody');
            tbody.innerHTML = '';
            
            filteredRecords.forEach(record => {
                const employee = employees.find(emp => emp.id === record.employeeId);
                if (!employee) return;
                
                let statusClass = '';
                switch(record.status) {
                    case 'Present': statusClass = 'status-present'; break;
                    case 'Absent': statusClass = 'status-absent'; break;
                    case 'Late': statusClass = 'status-late'; break;
                    case 'Half Day': statusClass = 'status-halfday'; break;
                    case 'Week Off': statusClass = 'status-weekoff'; break;
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${employee.id}</td>
                    <td>${employee.firstName} ${employee.lastName}</td>
                    <td>${employee.department}</td>
                    <td>${record.checkIn || '-'}</td>
                    <td>${record.checkOut || '-'}</td>
                    <td><span class="attendance-status ${statusClass}">${record.status}</span></td>
                    <td>${record.hours}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-attendance" data-id="${record.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            // Add edit listeners
            document.querySelectorAll('.edit-attendance').forEach(btn => {
                btn.addEventListener('click', function() {
                    editAttendance(this.getAttribute('data-id'));
                });
            });
        }

        function markAttendance(e) {
            e.preventDefault();
            
            const employeeId = document.getElementById('attendanceEmployee').value;
            const date = document.getElementById('attendanceDate').value;
            const checkIn = document.getElementById('checkInTime').value;
            const checkOut = document.getElementById('checkOutTime').value;
            const status = document.getElementById('attendanceStatus').value;
            const remarks = document.getElementById('attendanceRemarks').value;
            
            if (!employeeId) {
                alert('Please select an employee.');
                return;
            }
            
            // Calculate hours
            let hours = 0;
            if (checkIn && checkOut) {
                const start = new Date(`2000-01-01T${checkIn}`);
                const end = new Date(`2000-01-01T${checkOut}`);
                hours = (end - start) / (1000 * 60 * 60);
                hours = Math.round(hours * 10) / 10; // Round to 1 decimal
            }
            
            const newAttendance = {
                id: generateId('ATT'),
                employeeId,
                date,
                checkIn,
                checkOut,
                status,
                hours,
                remarks
            };
            
            attendanceRecords.push(newAttendance);
            alert('Attendance marked successfully!');
            document.getElementById('markAttendanceForm').reset();
            loadAttendanceData();
            updateDashboardStats();
            
            // Update chart
            updateAttendanceChart();
        }

        function generateAttendanceReport() {
            loadAttendanceData();
            alert('Attendance report generated!');
        }

        function exportAttendanceReport() {
            const date = document.getElementById('attendanceReportDate').value;
            const filteredRecords = attendanceRecords.filter(record => record.date === date);
            
            let csv = 'Employee ID,Name,Department,Check-in,Check-out,Status,Hours\n';
            filteredRecords.forEach(record => {
                const employee = employees.find(emp => emp.id === record.employeeId);
                if (employee) {
                    csv += `${employee.id},${employee.firstName} ${employee.lastName},${employee.department},${record.checkIn || '-'},${record.checkOut || '-'},${record.status},${record.hours}\n`;
                }
            });
            
            downloadCSV(csv, `attendance_report_${date}.csv`);
        }

        // ========== PAYROLL MANAGEMENT ==========
        function loadPayrollData() {
            const month = document.getElementById('payrollFilterMonth').value;
            const filteredRecords = payrollRecords.filter(record => record.month === month);
            
            const tbody = document.getElementById('payrollTableBody');
            tbody.innerHTML = '';
            
            let totalBasic = 0, totalAllowances = 0, totalDeductions = 0, totalNet = 0;
            
            filteredRecords.forEach(record => {
                const employee = employees.find(emp => emp.id === record.employeeId);
                if (!employee) return;
                
                totalBasic += record.basicSalary;
                totalAllowances += record.allowances;
                totalDeductions += record.deductions;
                totalNet += record.netSalary;
                
                let statusColor = '';
                switch(record.status) {
                    case 'Processed': statusColor = '#28a745'; break;
                    case 'Pending': statusColor = '#ffc107'; break;
                    case 'On Hold': statusColor = '#6c757d'; break;
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${employee.id}</td>
                    <td>${employee.firstName} ${employee.lastName}</td>
                    <td>₹${record.basicSalary.toLocaleString()}</td>
                    <td>₹${record.allowances.toLocaleString()}</td>
                    <td>₹${record.deductions.toLocaleString()}</td>
                    <td><strong>₹${record.netSalary.toLocaleString()}</strong></td>
                    <td><span style="color: ${statusColor}; font-weight: bold;">${record.status}</span></td>
                    <td>
                        <button class="btn btn-primary btn-sm view-payslip" data-id="${record.id}">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                        ${record.status === 'Pending' ? 
                            `<button class="btn btn-success btn-sm process-payment" data-id="${record.id}" style="margin-left: 5px;">
                                <i class="fas fa-check"></i>
                            </button>` : ''
                        }
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            // Update summary
            document.getElementById('totalPayrollAmount').textContent = totalNet.toLocaleString();
            document.getElementById('processedAmount').textContent = 
                payrollRecords.filter(p => p.status === 'Processed' && p.month === month)
                    .reduce((sum, p) => sum + p.netSalary, 0).toLocaleString();
            document.getElementById('pendingAmount').textContent = 
                payrollRecords.filter(p => p.status === 'Pending' && p.month === month)
                    .reduce((sum, p) => sum + p.netSalary, 0).toLocaleString();
            
            // Add event listeners
            document.querySelectorAll('.view-payslip').forEach(btn => {
                btn.addEventListener('click', function() {
                    viewPayslip(this.getAttribute('data-id'));
                });
            });
            
            document.querySelectorAll('.process-payment').forEach(btn => {
                btn.addEventListener('click', function() {
                    processPayment(this.getAttribute('data-id'));
                });
            });
        }

        function processPayroll(e) {
            e.preventDefault();
            
            const month = document.getElementById('payrollMonth').value;
            const department = document.getElementById('payrollDepartment').value;
            const bonusPercentage = parseInt(document.getElementById('bonusPercentage').value) || 0;
            
            // Process payroll for selected employees
            const eligibleEmployees = employees.filter(emp => 
                (!department || emp.department === department) && 
                emp.status === 'Active'
            );
            
            eligibleEmployees.forEach(emp => {
                // Check if payroll already exists for this month
                const existing = payrollRecords.find(p => 
                    p.employeeId === emp.id && p.month === month
                );
                
                if (!existing) {
                    const basicSalary = emp.salary;
                    const allowances = Math.round(basicSalary * (bonusPercentage / 100));
                    const deductions = Math.round(basicSalary * 0.08); // 8% deductions (PF, Tax, etc.)
                    const netSalary = basicSalary + allowances - deductions;
                    
                    const newPayroll = {
                        id: generateId('PAY'),
                        employeeId: emp.id,
                        month: month,
                        basicSalary: basicSalary,
                        allowances: allowances,
                        deductions: deductions,
                        netSalary: netSalary,
                        status: 'Pending',
                        paymentDate: ''
                    };
                    
                    payrollRecords.push(newPayroll);
                }
            });
            
            alert(`Payroll processed for ${eligibleEmployees.length} employees!`);
            loadPayrollData();
        }

        function generatePayslips() {
            const month = document.getElementById('payrollMonth').value;
            const filteredRecords = payrollRecords.filter(record => record.month === month);
            
            if (filteredRecords.length === 0) {
                alert('No payroll records found for the selected month.');
                return;
            }
            
            alert(`Generated ${filteredRecords.length} payslips for ${month}!`);
            // In a real application, this would generate PDF payslips
        }

        function processPayment(payrollId) {
            const payroll = payrollRecords.find(p => p.id === payrollId);
            if (payroll) {
                payroll.status = 'Processed';
                payroll.paymentDate = new Date().toISOString().split('T')[0];
                loadPayrollData();
                alert('Payment processed successfully!');
            }
        }

        // ========== LEAVE MANAGEMENT ==========
        function loadLeaveData() {
            const statusFilter = document.getElementById('leaveStatusFilter').value;
            const typeFilter = document.getElementById('leaveTypeFilter').value;
            
            let filteredRecords = leaveRecords;
            if (statusFilter) {
                filteredRecords = filteredRecords.filter(record => record.status === statusFilter);
            }
            if (typeFilter) {
                filteredRecords = filteredRecords.filter(record => record.type === typeFilter);
            }
            
            const tbody = document.getElementById('leaveTableBody');
            tbody.innerHTML = '';
            
            filteredRecords.forEach(record => {
                const employee = employees.find(emp => emp.id === record.employeeId);
                if (!employee) return;
                
                let statusColor = '';
                switch(record.status) {
                    case 'Approved': statusColor = '#28a745'; break;
                    case 'Pending': statusColor = '#ffc107'; break;
                    case 'Rejected': statusColor = '#dc3545'; break;
                    case 'Cancelled': statusColor = '#6c757d'; break;
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${record.appliedDate}</td>
                    <td>${employee.firstName} ${employee.lastName}</td>
                    <td>${record.type}</td>
                    <td>${record.fromDate} to ${record.toDate}</td>
                    <td>${record.duration} day(s)</td>
                    <td><span style="color: ${statusColor}; font-weight: bold;">${record.status}</span></td>
                    <td>
                        ${record.status === 'Pending' ? 
                            `<button class="btn btn-success btn-sm approve-leave" data-id="${record.id}" style="margin-right: 5px;">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-danger btn-sm reject-leave" data-id="${record.id}">
                                <i class="fas fa-times"></i>
                            </button>` : 
                            `<button class="btn btn-primary btn-sm view-leave" data-id="${record.id}">
                                <i class="fas fa-eye"></i>
                            </button>`
                        }
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            // Add event listeners
            document.querySelectorAll('.approve-leave').forEach(btn => {
                btn.addEventListener('click', function() {
                    updateLeaveStatus(this.getAttribute('data-id'), 'Approved');
                });
            });
            
            document.querySelectorAll('.reject-leave').forEach(btn => {
                btn.addEventListener('click', function() {
                    updateLeaveStatus(this.getAttribute('data-id'), 'Rejected');
                });
            });
        }

        function loadHolidays() {
            const container = document.getElementById('holidayList');
            container.innerHTML = '';
            
            holidays.forEach(holiday => {
                const div = document.createElement('div');
                div.className = 'employee-item';
                div.innerHTML = `
                    <div style="width: 40px; text-align: center; margin-right: 15px;">
                        <div style="font-weight: bold; color: var(--accent-color);">${new Date(holiday.date).getDate()}</div>
                        <div style="font-size: 0.8rem;">${new Date(holiday.date).toLocaleString('default', { month: 'short' })}</div>
                    </div>
                    <div class="employee-info">
                        <h4>${holiday.name}</h4>
                        <p>${holiday.type} - ${holiday.description}</p>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        function applyLeave(e) {
            e.preventDefault();
            
            const employeeId = 'EMP001'; // Current user
            const type = document.getElementById('leaveType').value;
            const fromDate = document.getElementById('leaveFrom').value;
            const toDate = document.getElementById('leaveTo').value;
            const duration = parseInt(document.getElementById('leaveDuration').value);
            const reason = document.getElementById('leaveReason').value;
            const contact = document.getElementById('leaveContact').value;
            
            if (duration <= 0) {
                alert('Please select valid dates.');
                return;
            }
            
            // Check leave balance
            if (type === 'Casual Leave' && duration > 12) {
                alert('Not enough casual leave balance.');
                return;
            }
            
            const newLeave = {
                id: generateId('LEV'),
                employeeId: employeeId,
                type: type,
                fromDate: fromDate,
                toDate: toDate,
                duration: duration,
                reason: reason,
                contact: contact,
                status: 'Pending',
                appliedDate: new Date().toISOString().split('T')[0]
            };
            
            leaveRecords.push(newLeave);
            alert('Leave application submitted successfully!');
            document.getElementById('leaveForm').reset();
            loadLeaveData();
            updateDashboardStats();
        }

        function calculateLeaveDuration() {
            const fromDate = new Date(document.getElementById('leaveFrom').value);
            const toDate = new Date(document.getElementById('leaveTo').value);
            
            if (fromDate && toDate && fromDate <= toDate) {
                const diffTime = Math.abs(toDate - fromDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                document.getElementById('leaveDuration').value = diffDays;
            } else {
                document.getElementById('leaveDuration').value = '';
            }
        }

        function updateLeaveStatus(leaveId, status) {
            const leave = leaveRecords.find(l => l.id === leaveId);
            if (leave) {
                leave.status = status;
                loadLeaveData();
                alert(`Leave ${status.toLowerCase()} successfully!`);
            }
        }

        // ========== SHIFT ROSTER ==========
        function loadRosterData() {
            const week = document.getElementById('viewRosterWeek').value;
            const filteredRosters = shiftRosters.filter(roster => roster.week === week);
            
            const container = document.getElementById('rosterCalendar');
            container.innerHTML = `
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Employee</th>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Mon</th>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Tue</th>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Wed</th>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Thu</th>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Fri</th>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Sat</th>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Sun</th>
                            <th style="padding: 10px; background: var(--primary-color); color: white;">Total Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${filteredRosters.map(roster => {
                            const employee = employees.find(emp => emp.id === roster.employeeId);
                            if (!employee) return '';
                            
                            return `
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #ddd;">${employee.firstName} ${employee.lastName}</td>
                                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                        <span class="shift-badge ${getShiftClass(roster.mon)}">${roster.mon}</span>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                        <span class="shift-badge ${getShiftClass(roster.tue)}">${roster.tue}</span>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                        <span class="shift-badge ${getShiftClass(roster.wed)}">${roster.wed}</span>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                        <span class="shift-badge ${getShiftClass(roster.thu)}">${roster.thu}</span>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                        <span class="shift-badge ${getShiftClass(roster.fri)}">${roster.fri}</span>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                        <span class="shift-badge ${getShiftClass(roster.sat)}">${roster.sat}</span>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                        <span class="shift-badge ${getShiftClass(roster.sun)}">${roster.sun}</span>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center; font-weight: bold;">
                                        ${roster.totalHours}
                                    </td>
                                </tr>
                            `;
                        }).join('')}
                    </tbody>
                </table>
            `;
        }

        function getShiftClass(shift) {
            switch(shift) {
                case 'Morning': return 'shift-morning';
                case 'Evening': return 'shift-evening';
                case 'Night': return 'shift-night';
                default: return '';
            }
        }

        function generateRoster(e) {
            e.preventDefault();
            
            const week = document.getElementById('rosterWeek').value;
            const department = document.getElementById('rosterDepartment').value;
            const autoAssign = document.getElementById('autoAssign').checked;
            
            if (!department) {
                alert('Please select a department.');
                return;
            }
            
            // Get employees from selected department
            const departmentEmployees = employees.filter(emp => 
                emp.department === department && emp.status === 'Active'
            );
            
            if (departmentEmployees.length === 0) {
                alert('No active employees found in selected department.');
                return;
            }
            
            // Generate roster for each employee
            departmentEmployees.forEach(emp => {
                // Check if roster already exists
                const existing = shiftRosters.find(r => 
                    r.employeeId === emp.id && r.week === week
                );
                
                if (!existing) {
                    // Generate random shifts
                    const shifts = ['Morning', 'Evening', 'Night', 'Off'];
                    const getRandomShift = () => shifts[Math.floor(Math.random() * shifts.length)];
                    
                    const newRoster = {
                        id: generateId('ROS'),
                        employeeId: emp.id,
                        week: week,
                        mon: autoAssign ? (emp.shift === 'Flexible' ? getRandomShift() : emp.shift) : 'Morning',
                        tue: autoAssign ? (emp.shift === 'Flexible' ? getRandomShift() : emp.shift) : 'Morning',
                        wed: autoAssign ? (emp.shift === 'Flexible' ? getRandomShift() : emp.shift) : 'Morning',
                        thu: autoAssign ? (emp.shift === 'Flexible' ? getRandomShift() : emp.shift) : 'Morning',
                        fri: autoAssign ? (emp.shift === 'Flexible' ? getRandomShift() : emp.shift) : 'Morning',
                        sat: 'Off',
                        sun: 'Off',
                        totalHours: 40
                    };
                    
                    shiftRosters.push(newRoster);
                }
            });
            
            alert(`Roster generated for ${departmentEmployees.length} employees!`);
            loadRosterData();
        }

        function publishRoster() {
            const week = document.getElementById('rosterWeek').value;
            const rosters = shiftRosters.filter(r => r.week === week);
            
            if (rosters.length === 0) {
                alert('No roster found for the selected week.');
                return;
            }
            
            // In a real app, this would notify employees
            alert(`Roster published for week ${week}! All employees will be notified.`);
        }

        // ========== PERFORMANCE MANAGEMENT ==========
        function loadPerformanceData() {
            const department = document.getElementById('performanceDepartmentFilter').value;
            
            let filteredRecords = performanceRecords;
            if (department) {
                filteredRecords = performanceRecords.filter(record => {
                    const employee = employees.find(emp => emp.id === record.employeeId);
                    return employee && employee.department === department;
                });
            }
            
            const tbody = document.getElementById('performanceTableBody');
            tbody.innerHTML = '';
            
            filteredRecords.forEach(record => {
                const employee = employees.find(emp => emp.id === record.employeeId);
                if (!employee) return;
                
                let ratingClass = '';
                switch(record.rating) {
                    case 'Excellent': ratingClass = 'score-excellent'; break;
                    case 'Good': ratingClass = 'score-good'; break;
                    case 'Average': ratingClass = 'score-average'; break;
                    case 'Poor': ratingClass = 'score-poor'; break;
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${employee.firstName} ${employee.lastName}</td>
                    <td>${employee.department}</td>
                    <td>${record.attendance}%</td>
                    <td>${record.taskCompletion}%</td>
                    <td>${record.customerRating}/5.0</td>
                    <td><strong>${record.overallScore}/100</strong></td>
                    <td>
                        <div class="performance-score ${ratingClass}">
                            ${record.overallScore}
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm view-performance" data-id="${record.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-warning btn-sm add-feedback" data-id="${record.id}" style="margin-left: 5px;">
                            <i class="fas fa-comment"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            // Add event listeners
            document.querySelectorAll('.view-performance').forEach(btn => {
                btn.addEventListener('click', function() {
                    viewPerformanceDetails(this.getAttribute('data-id'));
                });
            });
        }

        function setKPI(e) {
            e.preventDefault();
            
            const employeeId = document.getElementById('kpiEmployee').value;
            const quarter = document.getElementById('kpiQuarter').value;
            const target = document.getElementById('kpiTarget').value;
            const weightage = parseInt(document.getElementById('kpiWeightage').value);
            const deadline = document.getElementById('kpiDeadline').value;
            
            if (!employeeId || !target || !weightage || !deadline) {
                alert('Please fill in all required fields.');
                return;
            }
            
            if (weightage < 1 || weightage > 100) {
                alert('Weightage must be between 1 and 100.');
                return;
            }
            
            const newKPI = {
                id: generateId('KPI'),
                employeeId: employeeId,
                quarter: quarter,
                target: target,
                weightage: weightage,
                deadline: deadline,
                status: 'In Progress',
                achievement: 0
            };
            
            kpiRecords.push(newKPI);
            alert('KPI set successfully!');
            document.getElementById('kpiForm').reset();
        }

        // ========== TASK MANAGEMENT ==========
        function loadTaskData() {
            const statusFilter = document.getElementById('taskStatusFilter').value;
            const priorityFilter = document.getElementById('taskPriorityFilter').value;
            
            let filteredTasks = tasks;
            if (statusFilter) {
                filteredTasks = filteredTasks.filter(task => task.status === statusFilter);
            }
            if (priorityFilter) {
                filteredTasks = filteredTasks.filter(task => task.priority === priorityFilter);
            }
            
            const tbody = document.getElementById('taskTableBody');
            tbody.innerHTML = '';
            
            filteredTasks.forEach(task => {
                const employee = employees.find(emp => emp.id === task.assigneeId);
                if (!employee) return;
                
                let priorityClass = '';
                switch(task.priority) {
                    case 'High': priorityClass = 'priority-high'; break;
                    case 'Medium': priorityClass = 'priority-medium'; break;
                    case 'Low': priorityClass = 'priority-low'; break;
                }
                
                let statusClass = '';
                switch(task.status) {
                    case 'Pending': statusClass = 'task-pending'; break;
                    case 'In Progress': statusClass = 'task-inprogress'; break;
                    case 'Completed': statusClass = 'task-completed'; break;
                    case 'Overdue': statusClass = 'task-overdue'; break;
                }
                
                // Check if task is overdue
                const today = new Date();
                const dueDate = new Date(task.dueDate);
                const isOverdue = task.status !== 'Completed' && dueDate < today;
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${task.id}</td>
                    <td>${task.title}</td>
                    <td>${employee.firstName} ${employee.lastName}</td>
                    <td><span class="priority-badge ${priorityClass}">${task.priority}</span></td>
                    <td>${task.dueDate} ${isOverdue ? '<i class="fas fa-exclamation-circle" style="color: #dc3545; margin-left: 5px;"></i>' : ''}</td>
                    <td><span class="task-status ${statusClass}">${task.status}</span></td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <div style="flex: 1; height: 10px; background: #e9ecef; border-radius: 5px; overflow: hidden;">
                                <div style="width: ${task.progress}%; height: 100%; background: #28a745;"></div>
                            </div>
                            <span style="margin-left: 10px; font-size: 0.9rem;">${task.progress}%</span>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm view-task" data-id="${task.id}" style="margin-right: 5px;">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-warning btn-sm update-task" data-id="${task.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            // Update task chart
            updateTaskChart();
            
            // Add event listeners
            document.querySelectorAll('.view-task').forEach(btn => {
                btn.addEventListener('click', function() {
                    viewTaskDetails(this.getAttribute('data-id'));
                });
            });
        }

        function createTask(e) {
            e.preventDefault();
            
            const title = document.getElementById('taskTitle').value;
            const assigneeId = document.getElementById('taskAssignee').value;
            const priority = document.getElementById('taskPriority').value;
            const startDate = document.getElementById('taskStartDate').value;
            const dueDate = document.getElementById('taskDueDate').value;
            const description = document.getElementById('taskDescription').value;
            
            if (!title || !assigneeId || !priority || !dueDate) {
                alert('Please fill in all required fields.');
                return;
            }
            
            const newTask = {
                id: generateId('TASK'),
                title: title,
                assigneeId: assigneeId,
                priority: priority,
                startDate: startDate || new Date().toISOString().split('T')[0],
                dueDate: dueDate,
                status: 'Pending',
                progress: 0,
                description: description
            };
            
            tasks.push(newTask);
            alert('Task created successfully!');
            document.getElementById('taskForm').reset();
            loadTaskData();
        }

        function updateTaskChart() {
            const completed = tasks.filter(t => t.status === 'Completed').length;
            const inProgress = tasks.filter(t => t.status === 'In Progress').length;
            const pending = tasks.filter(t => t.status === 'Pending').length;
            const overdue = tasks.filter(t => {
                const today = new Date();
                const dueDate = new Date(t.dueDate);
                return t.status !== 'Completed' && dueDate < today;
            }).length;
            
            if (charts.task) {
                charts.task.data.datasets[0].data = [completed, inProgress, pending, overdue];
                charts.task.update();
            }
        }

        // ========== REPORTS & ANALYTICS ==========
        function generateReport(e) {
            e.preventDefault();
            
            const reportType = document.getElementById('reportType').value;
            const period = document.getElementById('reportPeriod').value;
            const department = document.getElementById('reportDepartment').value;
            let fromDate, toDate;
            
            if (period === 'custom') {
                fromDate = document.getElementById('reportFrom').value;
                toDate = document.getElementById('reportTo').value;
            } else {
                const today = new Date();
                if (period === 'monthly') {
                    const month = document.getElementById('reportMonth').value;
                    fromDate = month + '-01';
                    const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                    toDate = month + '-' + lastDay.getDate().toString().padStart(2, '0');
                } else if (period === 'quarterly') {
                    const quarter = Math.floor(today.getMonth() / 3) + 1;
                    const quarterStartMonth = (quarter - 1) * 3;
                    fromDate = `${today.getFullYear()}-${(quarterStartMonth + 1).toString().padStart(2, '0')}-01`;
                    const quarterEndMonth = quarterStartMonth + 2;
                    const lastDay = new Date(today.getFullYear(), quarterEndMonth + 1, 0);
                    toDate = `${today.getFullYear()}-${(quarterEndMonth + 1).toString().padStart(2, '0')}-${lastDay.getDate().toString().padStart(2, '0')}`;
                } else if (period === 'yearly') {
                    fromDate = `${today.getFullYear()}-01-01`;
                    toDate = `${today.getFullYear()}-12-31`;
                }
            }
            
            let reportData = '';
            
            switch(reportType) {
                case 'attendance':
                    reportData = generateAttendanceReportData(fromDate, toDate, department);
                    break;
                case 'payroll':
                    reportData = generatePayrollReportData(fromDate, toDate, department);
                    break;
                case 'leave':
                    reportData = generateLeaveReportData(fromDate, toDate, department);
                    break;
                case 'performance':
                    reportData = generatePerformanceReportData(fromDate, toDate, department);
                    break;
                case 'manpower':
                    reportData = generateManpowerReportData(fromDate, toDate, department);
                    break;
                case 'attrition':
                    reportData = generateAttritionReportData(fromDate, toDate, department);
                    break;
            }
            
            document.getElementById('reportOutput').innerHTML = reportData;
            alert('Report generated successfully!');
        }

        function generateAttendanceReportData(fromDate, toDate, department) {
            const filteredRecords = attendanceRecords.filter(record => {
                const recordDate = new Date(record.date);
                const from = new Date(fromDate);
                const to = new Date(toDate);
                const employee = employees.find(emp => emp.id === record.employeeId);
                return recordDate >= from && recordDate <= to && 
                       (!department || department === 'all' || (employee && employee.department === department));
            });
            
            let html = `
                <h3>Attendance Report</h3>
                <p><strong>Period:</strong> ${fromDate} to ${toDate}</p>
                <p><strong>Department:</strong> ${department === 'all' ? 'All Departments' : department}</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                            <th>Hours</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            filteredRecords.forEach(record => {
                const employee = employees.find(emp => emp.id === record.employeeId);
                if (employee) {
                    html += `
                        <tr>
                            <td>${record.date}</td>
                            <td>${employee.firstName} ${employee.lastName}</td>
                            <td>${employee.department}</td>
                            <td>${record.checkIn || '-'}</td>
                            <td>${record.checkOut || '-'}</td>
                            <td>${record.status}</td>
                            <td>${record.hours}</td>
                        </tr>
                    `;
                }
            });
            
            html += `
                    </tbody>
                </table>
                <p><strong>Total Records:</strong> ${filteredRecords.length}</p>
            `;
            
            return html;
        }

        function exportReport() {
            const reportOutput = document.getElementById('reportOutput').innerText;
            if (!reportOutput || reportOutput.includes('No Report Generated Yet')) {
                alert('Please generate a report first.');
                return;
            }
            
            const reportType = document.getElementById('reportType').value;
            const fileName = `${reportType}_report_${new Date().toISOString().split('T')[0]}.csv`;
            
            // Convert table to CSV
            const table = document.querySelector('#reportOutput table');
            if (table) {
                let csv = [];
                const rows = table.querySelectorAll('tr');
                
                rows.forEach(row => {
                    const rowData = [];
                    const cols = row.querySelectorAll('td, th');
                    cols.forEach(col => {
                        rowData.push(col.innerText);
                    });
                    csv.push(rowData.join(','));
                });
                
                downloadCSV(csv.join('\n'), fileName);
            } else {
                downloadCSV(reportOutput, fileName);
            }
        }

        // ========== UTILITY FUNCTIONS ==========
        function generateId(prefix) {
            return `${prefix}${Date.now()}${Math.floor(Math.random() * 1000)}`;
        }

        function formatDate(date) {
            return date.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
        }

        function getWeekNumber(date) {
            const d = new Date(date);
            d.setHours(0, 0, 0, 0);
            d.setDate(d.getDate() + 3 - (d.getDay() + 6) % 7);
            const week1 = new Date(d.getFullYear(), 0, 4);
            return d.getFullYear() + '-W' + 
                Math.round(((d - week1) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7 + 1)
                    .toString().padStart(2, '0');
        }

        function downloadCSV(csv, filename) {
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }

        function updatePagination(module, totalItems) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const pagination = document.getElementById(`${module}Pagination`);
            
            if (!pagination) return;
            
            pagination.innerHTML = '';
            
            // Previous button
            const prevBtn = document.createElement('button');
            prevBtn.className = 'pagination-btn';
            prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevBtn.disabled = currentPage === 1;
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    window[`load${module.charAt(0).toUpperCase() + module.slice(1)}Data`]();
                }
            });
            pagination.appendChild(prevBtn);
            
            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = `pagination-btn ${i === currentPage ? 'active' : ''}`;
                pageBtn.textContent = i;
                pageBtn.addEventListener('click', () => {
                    currentPage = i;
                    window[`load${module.charAt(0).toUpperCase() + module.slice(1)}Data`]();
                });
                pagination.appendChild(pageBtn);
            }
            
            // Next button
            const nextBtn = document.createElement('button');
            nextBtn.className = 'pagination-btn';
            nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    window[`load${module.charAt(0).toUpperCase() + module.slice(1)}Data`]();
                }
            });
            pagination.appendChild(nextBtn);
        }

        // ========== MODAL FUNCTIONS ==========
        function closeEmployeeModal() {
            document.getElementById('employeeModal').style.display = 'none';
        }

        function resetEmployeeForm() {
            if (confirm('Are you sure you want to reset the form? All changes will be lost.')) {
                document.getElementById('employeeForm').reset();
                document.getElementById('joinDate').value = new Date().toISOString().split('T')[0];
                document.getElementById('status').value = 'Active';
            }
        }

        function filterEmployees() {
            currentPage = 1;
            loadEmployeeData();
        }

        function filterPayroll() {
            loadPayrollData();
        }

        function filterLeaveApplications() {
            loadLeaveData();
        }

        function filterPerformance() {
            loadPerformanceData();
        }

        function filterTasks() {
            loadTaskData();
        }

        // ========== VIEW DETAILS FUNCTIONS ==========
        function viewEmployeeDetails(id) {
            // Implementation for viewing employee details
            alert(`View details for employee ${id}`);
        }

        function editAttendance(id) {
            // Implementation for editing attendance
            alert(`Edit attendance ${id}`);
        }

        function viewPayslip(id) {
            // Implementation for viewing payslip
            alert(`View payslip ${id}`);
        }

        function viewPerformanceDetails(id) {
            // Implementation for viewing performance details
            alert(`View performance details ${id}`);
        }

        function viewTaskDetails(id) {
            // Implementation for viewing task details
            alert(`View task details ${id}`);
        }

        // ========== UPDATE FUNCTIONS ==========
        function updateAttendanceChart() {
            const present = attendanceRecords.filter(a => a.status === 'Present').length;
            const absent = attendanceRecords.filter(a => a.status === 'Absent').length;
            const late = attendanceRecords.filter(a => a.status === 'Late').length;
            const halfday = attendanceRecords.filter(a => a.status === 'Half Day').length;
            
            if (charts.attendance) {
                charts.attendance.data.datasets[0].data = [present, absent, late, halfday];
                charts.attendance.update();
            }
        }

        function printRoster() {
            window.print();
        }

        function printReport() {
            const printContent = document.getElementById('reportOutput').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload();
        }
    </script>
</body>
</html>