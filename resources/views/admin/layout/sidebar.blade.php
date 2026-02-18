   <div class="container">
       <!-- Sidebar -->
       <div class="sidebar">
           <div class="logo">
               <h2>Mall<span>HRMS</span></h2>
               <p>Human Resource Management System</p>
           </div>

           <div class="user-profile">
               <div class="user-avatar" id="">
                   {{ collect(explode(' ', trim(Auth::guard('admin')->user()->name)))->filter()->take(2)->map(fn($w) => strtoupper(mb_substr($w, 0, 1)))->implode('') }}
               </div>

               <div class="user-info">
                   <h4 id="">{{ Auth::guard('admin')->user()->name }}</h4>
                   <p id="currentUserRole">Admin</p>
               </div>
           </div>

           <ul class="nav-menu">
               <li class="nav-item">
                   <a href="{{route('admin.index')}}" class="nav-link active" data-module="dashboard">
                       <i class="fas fa-tachometer-alt"></i>
                       <span>Dashboard</span>
                   </a>
               </li>

                <li class="nav-item">
                   <a href="{{route('admin.department.index')}}" class="nav-link" data-module="employee">
                       <i class="fas fa-users"></i>
                       <span>Department Management</span>
                   </a>
               </li>

               <li class="nav-item">
                   <a href="{{route('admin.module.index')}}" class="nav-link" data-module="employee">
                       <i class="fas fa-users"></i>
                       <span>Module</span>
                   </a>
               </li>
               
               <li class="nav-item">
                   <a href="{{route('admin.designation.index')}}" class="nav-link" data-module="employee">
                       <i class="fas fa-users"></i>
                       <span>Designation Management</span>
                   </a>
               </li>

               <li class="nav-item">
                   <a href="{{route('admin.employee.index')}}" class="nav-link" data-module="employee">
                       <i class="fas fa-users"></i>
                       <span>Employee Management</span>
                   </a>
               </li>
               
               <li class="nav-item">
                   <a href="{{route('admin.attendance.index')}}" class="nav-link" data-module="attendance">
                       <i class="fas fa-calendar-check"></i>
                       <span>Attendance & Shift</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="{{route('admin.payroll.index')}}" class="nav-link" data-module="payroll">
                       <i class="fas fa-file-invoice-dollar"></i>
                       <span>Payroll Management</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="{{route('admin.leave.index')}}" class="nav-link" data-module="leave">
                       <i class="fas fa-calendar-alt"></i>
                       <span>Leave & Holiday</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="{{route('admin.shift.index')}}" class="nav-link" data-module="roster">
                       <i class="fas fa-calendar-week"></i>
                       <span>Shift Roster</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="{{route('admin.performance.index')}}" class="nav-link" data-module="performance">
                       <i class="fas fa-chart-line"></i>
                       <span>Performance & KPI</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="{{route('admin.task.index')}}" class="nav-link" data-module="task">
                       <i class="fas fa-tasks"></i>
                       <span>Task Management</span>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="{{route('admin.report.index')}}" class="nav-link" data-module="reports">
                       <i class="fas fa-chart-bar"></i>
                       <span>Reports & Analytics</span>
                   </a>
               </li>

               <li class="nav-item">
                   <a href="{{route('admin.logout')}}" class="nav-link" data-module="reports">
                       <i class="fas fa-sign-out-alt"></i>
                       <span>Sign out</span>
                   </a>
               </li>

           </ul>

           <!--<div class="role-selector">-->
           <!--    <label for="roleSelect">Switch Role:</label>-->
           <!--    <select id="roleSelect">-->
           <!--        <option value="hr">HR Manager</option>-->
           <!--        <option value="store">Store Manager</option>-->
           <!--        <option value="supervisor">Supervisor</option>-->
           <!--        <option value="finance">Finance/Admin</option>-->
           <!--        <option value="employee">Employee</option>-->
           <!--    </select>-->
           <!--</div>-->
       </div>
