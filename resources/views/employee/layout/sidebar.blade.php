<style>
.logo-img {
    height: 40px;
    width: auto;
    object-fit: contain;
    background-color: #fff !important;
}
</style>

<nav class="sidebar" id="sidebar">

    <div class="logo-container">
        <a href="#" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/indra_hrms_logo.png') }}" alt="Logo" class="logo-img">
        </a>
    </div>

    <ul class="nav-menu">

        @if(hasPermission('dashboard'))
        <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @endif

        @if(hasPermission('attendance'))
        <li class="nav-item">
            <a href="{{ route('user.attendance.index') }}" class="nav-link">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li>
        @endif

        @if(hasPermission('leaves'))
        <li class="nav-item">
            <a href="{{route('user.leaves.index')}}" class="nav-link">
                <i class="fas fa-umbrella-beach"></i>
                <span>Leaves</span>
            </a>
        </li>
        @endif

        @if(hasPermission('payroll'))
        <li class="nav-item">
            <a href="{{route('user.payroll.index')}}" class="nav-link">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Payroll</span>
            </a>
        </li>
        @endif

        @if(hasPermission('performance'))
        <li class="nav-item">
            <a href="{{route('user.performance.index')}}" class="nav-link">
                <i class="fas fa-chart-line"></i>
                <span>Performance</span>
            </a>
        </li>
        @endif

        @if(hasPermission('training'))
        <li class="nav-item">
            <a href="{{route('user.training.index') }}" class="nav-link">
                <i class="fas fa-graduation-cap"></i>
                <span>Training</span>
            </a>
        </li>
        @endif

        @if(hasPermission('documents'))
        <li class="nav-item">
            <a href="{{route('user.document.index') }}" class="nav-link">
                <i class="fas fa-file-alt"></i>
                <span>Documents</span>
            </a>
        </li>
        @endif

        @if(hasPermission('profile'))
        <li class="nav-item">
            <a href="{{route('user.profile.index') }}" class="nav-link">
                <i class="fas fa-user-circle"></i>
                <span>My Profile</span>
            </a>
        </li>
        @endif

        @if(hasPermission('setting'))
        <li class="nav-item">
            <a href="{{route('user.setting.index') }}" class="nav-link">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>
        @endif

    </ul>

    <div class="employee-info">
        <div class="employee-avatar" id="userAvatar">
            {{ strtoupper(substr(Auth::guard('user')->user()->first_name,0,1)) }}
            {{ strtoupper(substr(Auth::guard('user')->user()->last_name,0,1)) }}
        </div>

        <div class="employee-details">
            <h4>
                {{ Auth::guard('user')->user()->first_name }}
                {{ Auth::guard('user')->user()->last_name }}
            </h4>
            <p>{{ Auth::guard('user')->user()->employee_code }}</p>
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

            <h3 id="pageTitle">
                Welcome :
                {{Auth::guard('user')->user()->first_name}}
                {{Auth::guard('user')->user()->last_name}}
                ({{Auth::guard('user')->user()->employee_code}})
            </h3>

            <p class="date-display" id="currentDate"></p>
        </div>

        <div class="header-actions">

            <div class="notification-icon" id="notificationIcon">
                <i class="fas fa-bell"></i>
                <span class="notification-badge" id="notificationCount">3</span>
            </div>

            <a href="{{ route('user.logout') }}" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>

        </div>

    </div>

    <!-- Content Area -->
    <div class="content-area">