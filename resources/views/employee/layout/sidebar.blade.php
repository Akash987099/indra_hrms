 <nav class="sidebar" id="sidebar">
     <div class="logo-container">
         <a href="#" class="logo">
             <i class="fas fa-users-cog"></i>
             <span>HRMS</span>
         </a>
     </div>

     <ul class="nav-menu">
         <li class="nav-item">
             <a href="{{route('user.index')}}" class="nav-link">
                 <i class="fas fa-tachometer-alt"></i>
                 <span>Dashboard</span>
             </a>
         </li>
         <li class="nav-item">
             <a href="{{ route('user.attendance.index') }}" class="nav-link">
                 <i class="fas fa-calendar-check"></i>
                 <span>Attendance</span>
             </a>
         </li>
         <li class="nav-item">
             <a href="{{route('user.leaves.index')}}" class="nav-link">
                 <i class="fas fa-umbrella-beach"></i>
                 <span>Leaves</span>
             </a>
         </li>
         <li class="nav-item">
             <a href="{{route('user.payroll.index')}}" class="nav-link">
                 <i class="fas fa-file-invoice-dollar"></i>
                 <span>Payroll</span>
             </a>
         </li>
         <li class="nav-item">
             <a href="{{route('user.performance.index')}}" class="nav-link">
                 <i class="fas fa-chart-line"></i>
                 <span>Performance</span>
             </a>
         </li>
         <li class="nav-item">
             <a href="{{route('user.training.index') }}" class="nav-link">
                 <i class="fas fa-graduation-cap"></i>
                 <span>Training</span>
             </a>
         </li>
         <li class="nav-item">
             <a  href="{{route('user.document.index') }}" class="nav-link">
                 <i class="fas fa-file-alt"></i>
                 <span>Documents</span>
             </a>
         </li>
         <li class="nav-item">
             <a href="{{route('user.profile.index') }}" class="nav-link">
                 <i class="fas fa-user-circle"></i>
                 <span>My Profile</span>
             </a>
         </li>
         <li class="nav-item">
             <a href="{{route('user.setting.index') }}" class="nav-link">
                 <i class="fas fa-cog"></i>
                 <span>Settings</span>
             </a>
         </li>
     </ul>

     <div class="employee-info">
         <div class="employee-avatar" id="userAvatar">JS</div>
         <div class="employee-details">
             <h4 id="">{{ Auth::guard('user')->user()->first_name }}
                 {{ Auth::guard('user')->user()->last_name }}</h4>
             <p id="">{{ Auth::guard('user')->user()->role }}</p>
             <p id="">{{ Auth::guard('user')->user()->employee_code }}</p>
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
             <h3 id="pageTitle">Welcome : {{Auth::guard('user')->user()->first_name}} {{Auth::guard('user')->user()->last_name}} ({{Auth::guard('user')->user()->employee_code}})</h3>
             <p class="date-display" id="currentDate"></p>
         </div>
         <div class="header-actions">
             <div class="notification-icon" id="notificationIcon">
                 <i class="fas fa-bell"></i>
                 <span class="notification-badge" id="notificationCount">3</span>
             </div>
             <button class="btn btn-danger" id="">
                 <a href="{{ route('user.logout') }}" style="color: #fff; text-decoration: none;"> <i
                         class="fas fa-sign-out-alt"></i> Logout </a>
             </button>
         </div>
     </div>

     <!-- Content Area -->
     <div class="content-area">
