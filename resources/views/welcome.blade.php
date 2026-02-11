<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mall Employee Onboarding Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        header {
            background: linear-gradient(135deg, #1a3a8f 0%, #2c5aa0 100%);
            color: white;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content h1 {
            font-size: 26px;
            margin-bottom: 5px;
        }

        .header-content p {
            font-size: 14px;
            opacity: 0.9;
        }

        .mall-logo {
            font-size: 36px;
            background-color: rgba(255, 255, 255, 0.1);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            padding: 30px;
        }

        .form-section {
            margin-bottom: 30px;
            border: 1px solid #e1e5eb;
            border-radius: 8px;
            padding: 25px;
            background-color: #f9fafc;
            position: relative;
        }

        .section-title {
            display: flex;
            align-items: center;
            color: #1a3a8f;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e1e5eb;
        }

        .section-title i {
            margin-right: 10px;
            font-size: 18px;
        }

        .section-title h2 {
            font-size: 18px;
        }

        .section-badge {
            background-color: #1a3a8f;
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin-left: 10px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 250px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d9e6;
            border-radius: 6px;
            font-size: 15px;
            transition: border 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #1a3a8f;
            box-shadow: 0 0 0 2px rgba(26, 58, 143, 0.1);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .checkbox-group,
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }

        .checkbox-item,
        .radio-item {
            display: flex;
            align-items: center;
        }

        .checkbox-item input,
        .radio-item input {
            width: auto;
            margin-right: 8px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e1e5eb;
        }

        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-submit {
            background-color: #27ae60;
            color: white;
        }

        .btn-submit:hover {
            background-color: #219653;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(33, 150, 83, 0.2);
        }

        .btn-reset {
            background-color: #e1e5eb;
            color: #444;
        }

        .btn-reset:hover {
            background-color: #d1d9e6;
        }

        .btn-preview {
            background-color: #3498db;
            color: white;
        }

        .btn-preview:hover {
            background-color: #2980b9;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
        }

        .status-message {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: none;
        }

        .success {
            background-color: #d5edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .filter-section {
            background-color: #e8f4ff;
            border-left: 4px solid #1a3a8f;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .filter-title {
            font-weight: 600;
            color: #1a3a8f;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .filter-title i {
            margin-right: 8px;
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .document-upload {
            border: 2px dashed #d1d9e6;
            padding: 25px;
            text-align: center;
            border-radius: 8px;
            margin-top: 15px;
            background-color: #fff;
            transition: all 0.3s;
        }

        .document-upload:hover {
            border-color: #1a3a8f;
            background-color: #f9fafc;
        }

        .document-upload i {
            font-size: 48px;
            color: #1a3a8f;
            margin-bottom: 15px;
        }

        .upload-btn {
            display: inline-block;
            background-color: #1a3a8f;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .upload-btn:hover {
            background-color: #2c5aa0;
        }

        .uploaded-files {
            margin-top: 20px;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: white;
            border: 1px solid #e1e5eb;
            border-radius: 6px;
            margin-bottom: 8px;
        }

        .file-info {
            display: flex;
            align-items: center;
        }

        .file-icon {
            color: #1a3a8f;
            margin-right: 10px;
        }

        .file-remove {
            color: #e74c3c;
            cursor: pointer;
        }

        .form-section:last-of-type {
            border: 2px dashed #d1d9e6;
            background-color: #fff;
        }

        .emergency-contact {
            background-color: #fff8e1;
            border: 1px solid #ffecb3;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }

        .department-size-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }

        .size-small {
            background-color: #d4edda;
            color: #155724;
        }

        .size-medium {
            background-color: #fff3cd;
            color: #856404;
        }

        .size-large {
            background-color: #f8d7da;
            color: #721c24;
        }

        .department-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .department-details {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }

        .department-details i {
            margin-right: 5px;
            font-size: 11px;
        }

        .date-highlight {
            background-color: #e8f4ff;
            padding: 10px;
            border-radius: 6px;
            border-left: 3px solid #1a3a8f;
        }

        .access-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
            margin-left: 5px;
        }

        .access-basic {
            background-color: #d4edda;
            color: #155724;
        }

        .access-managerial {
            background-color: #cce5ff;
            color: #004085;
        }

        .access-admin {
            background-color: #f8d7da;
            color: #721c24;
        }

        .access-finance {
            background-color: #fff3cd;
            color: #856404;
        }

        .hrms-feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .hrms-feature {
            background-color: white;
            border: 1px solid #e1e5eb;
            border-radius: 6px;
            padding: 15px;
            display: flex;
            align-items: flex-start;
        }

        .hrms-feature i {
            color: #1a3a8f;
            margin-right: 10px;
            margin-top: 3px;
        }

        .hrms-feature-content h4 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .hrms-feature-content p {
            font-size: 12px;
            color: #666;
        }

        @media (max-width: 992px) {
            .form-row {
                gap: 15px;
            }

            .form-group {
                min-width: 200px;
            }
        }

        @media (max-width: 768px) {

            .form-row,
            .filter-row {
                flex-direction: column;
                gap: 15px;
            }

            .form-group,
            .filter-group {
                min-width: 100%;
            }

            .form-footer {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 20px;
            }

            .form-section {
                padding: 15px;
            }
        }

        .highlight {
            background-color: #e8f4ff;
            padding: 2px 5px;
            border-radius: 3px;
        }

        .salary-preview {
            background-color: #f0f9ff;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
            display: none;
        }

        .salary-preview h4 {
            color: #1a3a8f;
            margin-bottom: 10px;
        }

        .salary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .salary-total {
            font-weight: bold;
            border-top: 1px solid #d1d9e6;
            padding-top: 8px;
            margin-top: 8px;
        }

        .date-row {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }

        .date-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .date-item {
            flex: 1;
            min-width: 200px;
        }

        .date-calculation {
            background-color: #e8f4ff;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="header-content">
                <h1>Mall Employee Onboarding System</h1>
                <p>Complete this form to onboard new mall employees</p>
            </div>
            <div class="mall-logo">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </header>

        <div class="form-container">
            <div id="statusMessage" class="status-message"></div>

            <form id="onboardingForm" method="POST">
                @csrf
                
                <input name="employee_id" id="employee_id" type="hidden" value="{{$employee->id}}">
                <!-- BASIC INFO -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-user"></i>
                        <h2>Basic Employee Information</h2>
                        <span class="section-badge">Required</span>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="employeeType" class="required">Employee Type</label>
                            <select id="employeeType" required onchange="updateDateCalculations()">
                                <option value="">-- Select Type --</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Contract">Contract</option>
                                <option value="Temporary">Temporary</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Trainee">Trainee</option>
                                <option value="Intern">Intern</option>
                                <option value="Vendor Staff">Vendor Staff</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fullName" class="required">Full Name</label>
                            <input type="text" id="fullName" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="mobile" class="required">Mobile Number</label>
                            <input type="tel" id="mobile" required pattern="[0-9]{10}">
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">Email Address</label>
                            <input type="email" id="email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="aadhaar" class="required">Aadhaar Number</label>
                            <input type="text" id="aadhaar" maxlength="12" pattern="[0-9]{12}" required>
                        </div>

                        <div class="form-group">
                            <label for="pan" class="required">PAN Number</label>
                            <input type="text" id="pan" maxlength="10" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}"
                                required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="dob" class="required">Date of Birth</label>
                            <input type="date" id="dob" required onchange="calculateAge()">
                        </div>

                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" id="age" readonly>
                        </div>
                    </div>

                    <!-- DATE OF JOINING SECTION -->
                    <div class="date-row">
                        <h4 style="color: #1a3a8f; margin-bottom: 15px;">Employment Dates</h4>
                        <div class="date-group">
                            <div class="date-item">
                                <label for="joiningDate" class="required">Date of Joining</label>
                                <input type="date" id="joiningDate" required onchange="updateDateCalculations()">
                            </div>

                            <div class="date-item">
                                <label for="contractEndDate">Contract End Date</label>
                                <input type="date" id="contractEndDate" onchange="calculateContractDuration()">
                            </div>

                            <div class="date-item">
                                <label for="probationEndDate">Probation End Date</label>
                                <input type="date" id="probationEndDate" readonly>
                            </div>
                        </div>

                        <div id="dateCalculation" class="date-calculation">
                            <!-- Date calculations will appear here -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="gender" class="required">Gender</label>
                            <select id="gender" required>
                                <option value="">-- Select --</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bloodGroup">Blood Group</label>
                            <select id="bloodGroup">
                                <option value="">-- Select --</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="address" class="required">Address</label>
                            <textarea id="address" required></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="district" class="required">District</label>
                            <input type="text" id="district" required>
                        </div>

                        <div class="form-group">
                            <label for="state" class="required">State</label>
                            <select id="state" required onchange="updateDistricts()">
                                <option value="">-- Select State --</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="West Bengal">West Bengal</option>
                                <option value="Rajasthan">Rajasthan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="pincode" class="required">Pincode</label>
                            <input type="text" id="pincode" maxlength="6" pattern="[0-9]{6}" required>
                        </div>

                        <div class="form-group">
                            <label for="maritalStatus">Marital Status</label>
                            <select id="maritalStatus">
                                <option value="">-- Select --</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>

                    <div class="emergency-contact">
                        <h4>Emergency Contact</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="emergencyName" class="required">Contact Person Name</label>
                                <input type="text" id="emergencyName" required>
                            </div>

                            <div class="form-group">
                                <label for="emergencyPhone" class="required">Contact Phone</label>
                                <input type="tel" id="emergencyPhone" required pattern="[0-9]{10}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="emergencyRelation">Relationship</label>
                                <input type="text" id="emergencyRelation">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DEPARTMENT & DESIGNATION -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-building"></i>
                        <h2>Department & Designation</h2>
                        <span class="section-badge">Required</span>
                    </div>

                    <!-- Department Size Filter -->
                    <div class="filter-section">
                        <div class="filter-title">
                            <i class="fas fa-filter"></i>
                            Department Filters
                        </div>
                        <div class="filter-row">
                            <div class="filter-group">
                                <label for="deptCategory">Department Category</label>
                                <select id="deptCategory" onchange="filterDepartments()">
                                    <option value="">All Categories</option>
                                    <option value="Operations">Operations</option>
                                    <option value="Operations">Sales & Marketing</option>
                                    <option value="Administration">Administration</option>
                                    <option value="Support">Support</option>
                                    <option value="Retail">Retail</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="deptSize">Department Size</label>
                                <select id="deptSize" onchange="filterDepartments()">
                                    <option value="">All Sizes</option>
                                    <option value="Small">Small (1-10 employees)</option>
                                    <option value="Medium">Medium (11-30 employees)</option>
                                    <option value="Large">Large (31+ employees)</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="deptLocation">Location</label>
                                <select id="deptLocation" onchange="filterDepartments()">
                                    <option value="">All Locations</option>
                                    <option value="Main">Main Building</option>
                                    <option value="Annex">Annex Building</option>
                                    <option value="Parking">Parking Complex</option>
                                    <option value="FoodCourt">Food Court Area</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Department Selection with Size Badges -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="department" class="required">Department</label>
                            <div style="position: relative;">
                                <select id="department" required onchange="loadDesignation()">
                                    <option value="">-- Select Department --</option>
                                    <!-- Departments will be populated dynamically -->
                                </select>
                                <div id="departmentDetails" style="margin-top: 8px; display: none;">
                                    <div class="department-details">
                                        <i class="fas fa-users"></i>
                                        <span id="deptEmployeeCount">0 employees</span>
                                        <span style="margin: 0 8px">•</span>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span id="deptLocationInfo">Location: </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="designation" class="required">Designation</label>
                            <select id="designation" required onchange="updateSalaryRange()">
                                <option value="">-- Select Designation --</option>
                                <!-- Designations will be loaded dynamically based on department -->
                            </select>
                            <div id="designationDetails" style="font-size: 12px; color: #666; margin-top: 5px;"></div>
                        </div>
                    </div>

                    <!-- Department Hierarchy -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="subDepartment">Sub-Department / Unit</label>
                            <select id="subDepartment">
                                <option value="">-- Select Sub-Department --</option>
                                <!-- Will be populated based on department -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="team">Team / Squad</label>
                            <select id="team">
                                <option value="">-- Select Team --</option>
                                <!-- Will be populated based on sub-department -->
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="workArea" class="required">Work Area</label>
                            <select id="workArea" required onchange="updateWorkAreaDetails()">
                                <option value="">-- Select Work Area --</option>
                                <option value="Entire Mall">Entire Mall</option>
                                <option value="Store">Store</option>
                                <option value="Food Court">Food Court</option>
                                <option value="Parking Area">Parking Area</option>
                                <option value="Warehouse">Warehouse</option>
                                <option value="Admin Office">Admin Office</option>
                                <option value="Security Room">Security Room</option>
                                <option value="Technical Room">Technical Room</option>
                                <option value="Customer Service Desk">Customer Service Desk</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="shift" class="required">Shift</label>
                            <select id="shift" required onchange="updateShiftAllowance()">
                                <option value="">-- Select Shift --</option>
                                <option value="General">General (9 AM - 6 PM)</option>
                                <option value="Morning">Morning (7 AM - 3 PM)</option>
                                <option value="Evening">Evening (3 PM - 11 PM)</option>
                                <option value="Night">Night (11 PM - 7 AM)</option>
                                <option value="Rotational">Rotational</option>
                                <option value="Flexible">Flexible Hours</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="reportingManager">Reporting Manager</label>
                            <select id="reportingManager" onchange="updateManagerDetails()">
                                <option value="">-- Select Manager --</option>
                                <!-- Will be populated based on department -->
                            </select>
                            <div id="managerDetails" style="font-size: 12px; color: #666; margin-top: 5px;"></div>
                        </div>

                        <div class="form-group">
                            <label for="probationPeriod">Probation Period</label>
                            <select id="probationPeriod" onchange="updateProbationEndDate()">
                                <option value="0">No Probation</option>
                                <option value="1">1 Month</option>
                                <option value="3">3 Months</option>
                                <option value="6" selected>6 Months</option>
                                <option value="12">12 Months</option>
                            </select>
                        </div>
                    </div>

                    <!-- Department Statistics -->
                    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 6px; margin-top: 15px;">
                        <h4 style="color: #1a3a8f; margin-bottom: 10px;">Department Statistics</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Total Employees in Department</label>
                                <input type="text" id="totalDeptEmployees" readonly>
                            </div>

                            <div class="form-group">
                                <label>Vacant Positions</label>
                                <input type="text" id="vacantPositions" readonly>
                            </div>

                            <div class="form-group">
                                <label>Average Salary in Department</label>
                                <input type="text" id="avgDeptSalary" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- HRMS & PAYROLL -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-users-cog"></i>
                        <h2>HRMS Access & Payroll Details</h2>
                    </div>

                    <!-- Enhanced HRMS Access Filters -->
                    <div class="filter-section">
                        <div class="filter-title">
                            <i class="fas fa-filter"></i>
                            HRMS Access Configuration
                        </div>
                        <div class="filter-row">
                            <div class="filter-group">
                                <label for="accessLevel">Access Level</label>
                                <select id="accessLevel" onchange="filterHRMSAccess()">
                                    <option value="">All Access Levels</option>
                                    <option value="Basic">Basic Access</option>
                                    <option value="Managerial">Managerial Access</option>
                                    <option value="Admin">Admin Access</option>
                                    <option value="Finance">Finance Access</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="accessDepartment">Department Access</label>
                                <select id="accessDepartment" onchange="filterHRMSAccess()">
                                    <option value="">All Departments</option>
                                    <option value="Own">Own Department Only</option>
                                    <option value="Multiple">Multiple Departments</option>
                                    <option value="All">All Departments</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="accessModule">Module Access</label>
                                <select id="accessModule" onchange="filterHRMSAccess()">
                                    <option value="">All Modules</option>
                                    <option value="Attendance">Attendance Module</option>
                                    <option value="Payroll">Payroll Module</option>
                                    <option value="Leave">Leave Module</option>
                                    <option value="Recruitment">Recruitment Module</option>
                                    <option value="Reports">Reports Module</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- HRMS Access Features -->
                    <div class="hrms-feature-grid">
                        <div class="hrms-feature">
                            <i class="fas fa-fingerprint"></i>
                            <div class="hrms-feature-content">
                                <h4>Biometric Access</h4>
                                <p>Access to biometric attendance system</p>
                            </div>
                        </div>

                        <div class="hrms-feature">
                            <i class="fas fa-calendar-check"></i>
                            <div class="hrms-feature-content">
                                <h4>Leave Management</h4>
                                <p>Apply and approve leaves</p>
                            </div>
                        </div>

                        <div class="hrms-feature">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <div class="hrms-feature-content">
                                <h4>Payroll Access</h4>
                                <p>View salary slips and tax details</p>
                            </div>
                        </div>

                        <div class="hrms-feature">
                            <i class="fas fa-chart-line"></i>
                            <div class="hrms-feature-content">
                                <h4>Reports & Analytics</h4>
                                <p>Access to performance reports</p>
                            </div>
                        </div>

                        <div class="hrms-feature">
                            <i class="fas fa-users"></i>
                            <div class="hrms-feature-content">
                                <h4>Team Management</h4>
                                <p>Manage team members and tasks</p>
                            </div>
                        </div>

                        <div class="hrms-feature">
                            <i class="fas fa-tasks"></i>
                            <div class="hrms-feature-content">
                                <h4>Task Assignment</h4>
                                <p>Assign and track tasks</p>
                            </div>
                        </div>
                    </div>

                    <!-- HRMS Access Level with Features -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="hrmsAccess" class="required">HRMS Access Level</label>
                            <select id="hrmsAccess" required onchange="updateAccessDescription()">
                                <option value="">-- Select Access Level --</option>
                                <!-- Options will be populated with access badges -->
                            </select>
                            <div id="accessDescription" style="font-size: 12px; color: #666; margin-top: 5px;"></div>
                        </div>

                        <div class="form-group">
                            <label for="accessExpiry">Access Expiry Date</label>
                            <input type="date" id="accessExpiry">
                        </div>
                    </div>

                    <!-- HRMS Modules Access -->
                    <div style="margin-top: 20px;">
                        <label>HRMS Module Access</label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="moduleAttendance" value="Attendance" checked>
                                <label for="moduleAttendance">Attendance Management</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="moduleLeave" value="Leave" checked>
                                <label for="moduleLeave">Leave Management</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="modulePayroll" value="Payroll">
                                <label for="modulePayroll">Payroll Processing</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="moduleRecruitment" value="Recruitment">
                                <label for="moduleRecruitment">Recruitment</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="moduleReports" value="Reports">
                                <label for="moduleReports">Reports & Analytics</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="moduleTraining" value="Training">
                                <label for="moduleTraining">Training Management</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="modulePerformance" value="Performance">
                                <label for="modulePerformance">Performance Management</label>
                            </div>

                            <div class="checkbox-item">
                                <input type="checkbox" id="moduleCompliance" value="Compliance">
                                <label for="moduleCompliance">Compliance Tracking</label>
                            </div>
                        </div>
                    </div>

                    <!-- Payroll Details -->
                    <div style="margin-top: 25px;">
                        <h4 style="color: #1a3a8f; margin-bottom: 15px;">Payroll Configuration</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="salaryType" class="required">Salary Type</label>
                                <select id="salaryType" required onchange="updateSalaryPreview()">
                                    <option value="">-- Select Type --</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Daily">Daily</option>
                                    <option value="Hourly">Hourly</option>
                                    <option value="Commission">Commission Based</option>
                                    <option value="Fixed+Commission">Fixed + Commission</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="salaryAmount" class="required">Basic Salary (₹)</label>
                                <input type="number" id="salaryAmount" min="0" step="100" required
                                    onchange="updateSalaryPreview()">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="paymentMode">Payment Mode</label>
                                <select id="paymentMode">
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paymentDate">Payment Date</label>
                                <select id="paymentDate">
                                    <option value="1">1st of Month</option>
                                    <option value="5">5th of Month</option>
                                    <option value="7" selected>7th of Month</option>
                                    <option value="10">10th of Month</option>
                                    <option value="15">15th of Month</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="bankName">Bank Name</label>
                                <input type="text" id="bankName">
                            </div>

                            <div class="form-group">
                                <label for="accountNumber">Account Number</label>
                                <input type="text" id="accountNumber">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="ifscCode">IFSC Code</label>
                                <input type="text" id="ifscCode">
                            </div>

                            <div class="form-group">
                                <label for="uanNumber">UAN Number (PF)</label>
                                <input type="text" id="uanNumber">
                            </div>
                        </div>

                        <!-- Salary Preview -->
                        <div id="salaryPreview" class="salary-preview">
                            <h4>Salary Breakup Preview</h4>
                            <div class="salary-item">
                                <span>Basic Salary:</span>
                                <span id="previewBasic">₹0</span>
                            </div>
                            <div class="salary-item">
                                <span>HRA (40%):</span>
                                <span id="previewHRA">₹0</span>
                            </div>
                            <div class="salary-item">
                                <span>Conveyance Allowance:</span>
                                <span id="previewConveyance">₹0</span>
                            </div>
                            <div class="salary-item">
                                <span>Shift Allowance:</span>
                                <span id="previewShift">₹0</span>
                            </div>
                            <div class="salary-item">
                                <span>Medical Allowance:</span>
                                <span id="previewMedical">₹0</span>
                            </div>
                            <div class="salary-item">
                                <span>PF Contribution (12%):</span>
                                <span id="previewPF">₹0</span>
                            </div>
                            <div class="salary-item salary-total">
                                <span>Monthly Take Home:</span>
                                <span id="previewTotal">₹0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DOCUMENTS UPLOAD -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-file-alt"></i>
                        <h2>Document Upload & Checklist</h2>
                    </div>

                    <div class="document-upload">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h3>Upload Employee Documents</h3>
                        <p>Supported formats: PDF, JPG, PNG (Max size: 5MB each)</p>
                        <input type="file" id="fileUpload" multiple style="display: none;"
                            onchange="handleFileUpload()">
                        <div class="upload-btn" onclick="document.getElementById('fileUpload').click()">
                            <i class="fas fa-plus"></i> Select Files
                        </div>
                    </div>

                    <div class="uploaded-files" id="uploadedFiles">
                        <!-- Uploaded files will appear here -->
                    </div>

                    <h4 style="margin-top: 25px;">Document Checklist</h4>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="docAadhaar" value="Aadhaar" required>
                            <label for="docAadhaar" class="required">Aadhaar Card</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docPAN" value="PAN" required>
                            <label for="docPAN" class="required">PAN Card</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docBank" value="Bank Details" required>
                            <label for="docBank" class="required">Bank Account Details</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docPhoto" value="Photographs" required>
                            <label for="docPhoto" class="required">Passport Size Photos (2)</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docOffer" value="Offer Letter" required>
                            <label for="docOffer" class="required">Offer Letter (Signed)</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docJoining" value="Joining Report">
                            <label for="docJoining">Joining Report</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docPolice" value="Police Verification">
                            <label for="docPolice">Police Verification</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docEducation" value="Education">
                            <label for="docEducation">Education Certificates</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docExperience" value="Experience">
                            <label for="docExperience">Experience Letters</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docMedical" value="Medical">
                            <label for="docMedical">Medical Fitness Certificate</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox" id="docResume" value="Resume">
                            <label for="docResume">Resume/CV</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <label for="additionalNotes">Additional Notes</label>
                        <textarea id="additionalNotes" placeholder="Any additional notes or comments..."></textarea>
                    </div>
                </div>

                <!-- FORM FOOTER -->
                <div class="form-footer">
                    <button type="button" class="btn btn-reset" onclick="resetForm()">
                        <i class="fas fa-redo"></i> Reset Form
                    </button>

                    <button type="button" class="btn btn-preview" onclick="previewForm()">
                        <i class="fas fa-eye"></i> Preview
                    </button>

                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-user-check"></i> Submit Onboarding
                    </button>
                </div>
            </form>
        </div>
    </div>
    
   @if(!empty($employee))
    <script>
        window.isEdit = true;
        window.employeeData = @json($employee);
    </script>
@elseif(!empty($employeedata))
    <script>
        window.isEdit = true;
        window.employeeData = @json($employeedata);
    </script>
@endif

    <script>
        // Department data with detailed information
        const departments = [{
                name: "Admin",
                category: "Administration",
                size: "Medium",
                location: "Main",
                employees: 15,
                vacancies: 2,
                avgSalary: 45000
            },
            {
                name: "Retail",
                category: "Retail",
                size: "Large",
                location: "Main",
                employees: 85,
                vacancies: 10,
                avgSalary: 28000
            },
            {
                name: "Security",
                category: "Operations",
                size: "Large",
                location: "Main",
                employees: 65,
                vacancies: 5,
                avgSalary: 22000
            },
            {
                name: "Housekeeping",
                category: "Operations",
                size: "Large",
                location: "Main",
                employees: 75,
                vacancies: 8,
                avgSalary: 15000
            },
            {
                name: "Technical",
                category: "Support",
                size: "Medium",
                location: "Annex",
                employees: 25,
                vacancies: 3,
                avgSalary: 32000
            },
            {
                name: "Parking",
                category: "Operations",
                size: "Medium",
                location: "Parking",
                employees: 35,
                vacancies: 4,
                avgSalary: 18000
            },
            {
                name: "FoodCourt",
                category: "Retail",
                size: "Medium",
                location: "FoodCourt",
                employees: 45,
                vacancies: 6,
                avgSalary: 20000
            },
            {
                name: "CustomerSupport",
                category: "Support",
                size: "Small",
                location: "Main",
                employees: 12,
                vacancies: 2,
                avgSalary: 22000
            },
            {
                name: "Finance",
                category: "Administration",
                size: "Small",
                location: "Main",
                employees: 8,
                vacancies: 1,
                avgSalary: 50000
            },
            {
                name: "Marketing",
                category: "Administration",
                size: "Small",
                location: "Main",
                employees: 6,
                vacancies: 1,
                avgSalary: 40000
            },
            {
                name: "IT",
                category: "Support",
                size: "Small",
                location: "Annex",
                employees: 10,
                vacancies: 2,
                avgSalary: 45000
            },
            {
                name: "HR",
                category: "Administration",
                size: "Small",
                location: "Main",
                employees: 5,
                vacancies: 0,
                avgSalary: 48000
            }
        ];

        // Department to Designation mapping with salary ranges
        const designations = {
            Admin: [{
                    name: "Mall Manager",
                    minSalary: 80000,
                    maxSalary: 120000
                },
                {
                    name: "HR Manager",
                    minSalary: 50000,
                    maxSalary: 80000
                },
                {
                    name: "Accounts Manager",
                    minSalary: 45000,
                    maxSalary: 70000
                },
                {
                    name: "Admin Officer",
                    minSalary: 25000,
                    maxSalary: 40000
                },
                {
                    name: "Receptionist",
                    minSalary: 18000,
                    maxSalary: 25000
                },
                {
                    name: "Data Entry Operator",
                    minSalary: 15000,
                    maxSalary: 22000
                }
            ],
            Retail: [{
                    name: "Store Manager",
                    minSalary: 35000,
                    maxSalary: 60000
                },
                {
                    name: "Floor Manager",
                    minSalary: 30000,
                    maxSalary: 45000
                },
                {
                    name: "Sales Executive",
                    minSalary: 15000,
                    maxSalary: 25000
                },
                {
                    name: "Cashier",
                    minSalary: 13000,
                    maxSalary: 20000
                },
                {
                    name: "Visual Merchandiser",
                    minSalary: 18000,
                    maxSalary: 28000
                },
                {
                    name: "Inventory Controller",
                    minSalary: 16000,
                    maxSalary: 24000
                }
            ],
            Security: [{
                    name: "Security Manager",
                    minSalary: 30000,
                    maxSalary: 45000
                },
                {
                    name: "Security Supervisor",
                    minSalary: 22000,
                    maxSalary: 32000
                },
                {
                    name: "Security Guard",
                    minSalary: 14000,
                    maxSalary: 20000
                },
                {
                    name: "CCTV Operator",
                    minSalary: 16000,
                    maxSalary: 24000
                },
                {
                    name: "Fire Safety Officer",
                    minSalary: 20000,
                    maxSalary: 30000
                }
            ],
            Housekeeping: [{
                    name: "Housekeeping Supervisor",
                    minSalary: 18000,
                    maxSalary: 25000
                },
                {
                    name: "Cleaner",
                    minSalary: 10000,
                    maxSalary: 15000
                },
                {
                    name: "Janitor",
                    minSalary: 11000,
                    maxSalary: 16000
                },
                {
                    name: "Pest Control Technician",
                    minSalary: 15000,
                    maxSalary: 22000
                }
            ],
            Technical: [{
                    name: "Electrician",
                    minSalary: 20000,
                    maxSalary: 30000
                },
                {
                    name: "Plumber",
                    minSalary: 18000,
                    maxSalary: 25000
                },
                {
                    name: "HVAC Technician",
                    minSalary: 22000,
                    maxSalary: 32000
                },
                {
                    name: "Lift Operator",
                    minSalary: 15000,
                    maxSalary: 22000
                },
                {
                    name: "Maintenance Engineer",
                    minSalary: 30000,
                    maxSalary: 45000
                }
            ],
            Parking: [{
                    name: "Parking Manager",
                    minSalary: 25000,
                    maxSalary: 35000
                },
                {
                    name: "Parking Supervisor",
                    minSalary: 18000,
                    maxSalary: 25000
                },
                {
                    name: "Parking Attendant",
                    minSalary: 12000,
                    maxSalary: 18000
                },
                {
                    name: "Valet",
                    minSalary: 13000,
                    maxSalary: 20000
                }
            ],
            FoodCourt: [{
                    name: "Food Court Manager",
                    minSalary: 30000,
                    maxSalary: 45000
                },
                {
                    name: "Chef",
                    minSalary: 25000,
                    maxSalary: 40000
                },
                {
                    name: "Kitchen Helper",
                    minSalary: 12000,
                    maxSalary: 18000
                },
                {
                    name: "Service Staff",
                    minSalary: 13000,
                    maxSalary: 19000
                },
                {
                    name: "Cashier",
                    minSalary: 14000,
                    maxSalary: 20000
                },
                {
                    name: "Cleaner",
                    minSalary: 10000,
                    maxSalary: 15000
                }
            ],
            CustomerSupport: [{
                    name: "Helpdesk Executive",
                    minSalary: 15000,
                    maxSalary: 22000
                },
                {
                    name: "Customer Care Officer",
                    minSalary: 16000,
                    maxSalary: 24000
                },
                {
                    name: "Information Desk Staff",
                    minSalary: 14000,
                    maxSalary: 20000
                },
                {
                    name: "Lost & Found Officer",
                    minSalary: 15000,
                    maxSalary: 22000
                }
            ],
            Finance: [{
                    name: "Finance Manager",
                    minSalary: 50000,
                    maxSalary: 80000
                },
                {
                    name: "Accountant",
                    minSalary: 25000,
                    maxSalary: 40000
                },
                {
                    name: "Accounts Executive",
                    minSalary: 20000,
                    maxSalary: 30000
                }
            ],
            Marketing: [{
                    name: "Marketing Manager",
                    minSalary: 40000,
                    maxSalary: 60000
                },
                {
                    name: "Marketing Executive",
                    minSalary: 20000,
                    maxSalary: 30000
                }
            ],
            IT: [{
                    name: "IT Manager",
                    minSalary: 45000,
                    maxSalary: 70000
                },
                {
                    name: "System Administrator",
                    minSalary: 30000,
                    maxSalary: 45000
                },
                {
                    name: "IT Support",
                    minSalary: 20000,
                    maxSalary: 30000
                }
            ],
            HR: [{
                    name: "HR Manager",
                    minSalary: 50000,
                    maxSalary: 80000
                },
                {
                    name: "HR Executive",
                    minSalary: 25000,
                    maxSalary: 40000
                },
                {
                    name: "Recruitment Officer",
                    minSalary: 22000,
                    maxSalary: 35000
                }
            ]
        };

        // HRMS Access Levels with details
        const hrmsAccessLevels = [{
                name: "No Access",
                level: "Basic",
                department: "Own",
                module: "None",
                description: "Employee cannot access HRMS system"
            },
            {
                name: "Employee Self Service",
                level: "Basic",
                department: "Own",
                module: "Attendance,Leave",
                description: "Can view own details, apply for leaves, view payslips"
            },
            {
                name: "Supervisor",
                level: "Managerial",
                department: "Own",
                module: "Attendance,Leave,Reports",
                description: "Can view team details, approve leaves for subordinates"
            },
            {
                name: "Manager",
                level: "Managerial",
                department: "Multiple",
                module: "Attendance,Leave,Reports,Performance",
                description: "Full access to department data, can approve budgets, view reports"
            },
            {
                name: "HR/Admin",
                level: "Admin",
                department: "All",
                module: "All",
                description: "Full system access including employee data, payroll, and settings"
            },
            {
                name: "Finance",
                level: "Finance",
                department: "Multiple",
                module: "Payroll,Reports",
                description: "Access to payroll, budgets, and financial reports"
            },
            {
                name: "Department Head",
                level: "Managerial",
                department: "Own",
                module: "All",
                description: "Full access to department with additional reporting capabilities"
            },
            {
                name: "Payroll Officer",
                level: "Finance",
                department: "All",
                module: "Payroll",
                description: "Access to payroll processing and salary details"
            },
            {
                name: "Recruitment Officer",
                level: "Admin",
                department: "All",
                module: "Recruitment",
                description: "Access to recruitment module and candidate management"
            }
        ];

        // State to District mapping
        const stateDistricts = {
            "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Thane", "Nashik", "Aurangabad"],
            "Delhi": ["Central Delhi", "East Delhi", "New Delhi", "North Delhi", "South Delhi", "West Delhi"],
            "Karnataka": ["Bengaluru", "Mysuru", "Hubballi", "Belagavi", "Mangaluru", "Kalaburagi"],
            "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem", "Tirunelveli"],
            "Uttar Pradesh": ["Lucknow", "Kanpur", "Ghaziabad", "Agra", "Varanasi", "Prayagraj"],
            "Gujarat": ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Bhavnagar", "Jamnagar"],
            "West Bengal": ["Kolkata", "Howrah", "Durgapur", "Asansol", "Siliguri", "Bardhaman"],
            "Rajasthan": ["Jaipur", "Jodhpur", "Kota", "Bikaner", "Ajmer", "Udaipur"]
        };

        // Initialize the form
        window.onload = function() {
            populateDepartments();
            populateHRMSAccess();
            setDefaultDates();
            updateDateCalculations();
        };

        // Populate departments dropdown with size badges
        function populateDepartments() {
            const deptSelect = document.getElementById("department");

            // Clear existing options except the first one
            while (deptSelect.options.length > 1) {
                deptSelect.remove(1);
            }

            // Add department options with size badges
            departments.forEach(dept => {
                const option = document.createElement("option");
                option.value = dept.name;

                // Create department name with size badge
                let sizeBadgeClass = "";
                if (dept.size === "Small") sizeBadgeClass = "size-small";
                if (dept.size === "Medium") sizeBadgeClass = "size-medium";
                if (dept.size === "Large") sizeBadgeClass = "size-large";

                const sizeBadge = `<span class="department-size-badge ${sizeBadgeClass}">${dept.size}</span>`;
                option.innerHTML = `${dept.name} ${sizeBadge}`;

                // Set data attributes
                option.setAttribute('data-category', dept.category);
                option.setAttribute('data-size', dept.size);
                option.setAttribute('data-location', dept.location);
                option.setAttribute('data-employees', dept.employees);
                option.setAttribute('data-vacancies', dept.vacancies);
                option.setAttribute('data-avgsalary', dept.avgSalary);

                deptSelect.appendChild(option);
            });
        }

        // Populate HRMS Access dropdown with badges
        function populateHRMSAccess() {
            const accessSelect = document.getElementById("hrmsAccess");

            // Clear existing options except the first one
            while (accessSelect.options.length > 1) {
                accessSelect.remove(1);
            }

            // Add access level options with badges
            hrmsAccessLevels.forEach(access => {
                const option = document.createElement("option");
                option.value = access.name;

                // Create access name with badge
                let accessBadgeClass = "";
                if (access.level === "Basic") accessBadgeClass = "access-basic";
                if (access.level === "Managerial") accessBadgeClass = "access-managerial";
                if (access.level === "Admin") accessBadgeClass = "access-admin";
                if (access.level === "Finance") accessBadgeClass = "access-finance";

                const accessBadge = `<span class="access-badge ${accessBadgeClass}">${access.level}</span>`;
                option.innerHTML = `${access.name} ${accessBadge}`;

                // Set data attributes
                option.setAttribute('data-level', access.level);
                option.setAttribute('data-department', access.department);
                option.setAttribute('data-module', access.module);
                option.setAttribute('data-description', access.description);

                accessSelect.appendChild(option);
            });
        }

        // Load designations based on selected department
        function loadDesignation() {
            const dept = document.getElementById("department").value;
            const designationSelect = document.getElementById("designation");

            // Clear existing options except the first one
            while (designationSelect.options.length > 1) {
                designationSelect.remove(1);
            }

            // Update department details
            updateDepartmentDetails(dept);

            // If a department is selected, populate the designation dropdown
            if (dept && designations[dept]) {
                designations[dept].forEach(role => {
                    const option = document.createElement("option");
                    option.value = role.name;
                    option.textContent = role.name;
                    option.setAttribute('data-min-salary', role.minSalary);
                    option.setAttribute('data-max-salary', role.maxSalary);
                    designationSelect.appendChild(option);
                });

                // Update salary range hint
                updateSalaryRange();
            }

            // Update reporting managers based on department
            updateReportingManagers(dept);
            updateSubDepartments(dept);
        }

        // Update department details when selected
        function updateDepartmentDetails(deptName) {
            const deptDetails = document.getElementById("departmentDetails");
            const dept = departments.find(d => d.name === deptName);

            if (dept) {
                // Show department details
                deptDetails.style.display = "block";

                // Update employee count
                document.getElementById("deptEmployeeCount").textContent = `${dept.employees} employees`;

                // Update location info
                document.getElementById("deptLocationInfo").textContent = `Location: ${dept.location}`;

                // Update department statistics
                document.getElementById("totalDeptEmployees").value = dept.employees;
                document.getElementById("vacantPositions").value = dept.vacancies;
                document.getElementById("avgDeptSalary").value = `₹${dept.avgSalary.toLocaleString()}`;
            } else {
                deptDetails.style.display = "none";
            }
        }

        // Filter departments based on category, size and location
        function filterDepartments() {
            const category = document.getElementById("deptCategory").value;
            const size = document.getElementById("deptSize").value;
            const location = document.getElementById("deptLocation").value;
            const deptSelect = document.getElementById("department");
            const options = deptSelect.options;

            // Show or hide options based on filters
            for (let i = 1; i < options.length; i++) {
                const option = options[i];
                const deptCategory = option.getAttribute('data-category');
                const deptSize = option.getAttribute('data-size');
                const deptLocation = option.getAttribute('data-location');

                let show = true;

                if (category && deptCategory !== category) {
                    show = false;
                }

                if (size && deptSize !== size) {
                    show = false;
                }

                if (location && deptLocation !== location) {
                    show = false;
                }

                option.style.display = show ? '' : 'none';
                option.disabled = !show;
            }
        }

        // Filter HRMS access options
        function filterHRMSAccess() {
            const level = document.getElementById("accessLevel").value;
            const department = document.getElementById("accessDepartment").value;
            const module = document.getElementById("accessModule").value;
            const accessSelect = document.getElementById("hrmsAccess");
            const options = accessSelect.options;

            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                const accessLevel = option.getAttribute('data-level');
                const accessDept = option.getAttribute('data-department');
                const accessModule = option.getAttribute('data-module');

                let show = true;

                if (level && accessLevel !== level) {
                    show = false;
                }

                if (department && accessDept !== department) {
                    show = false;
                }

                if (module && module !== "All") {
                    if (module === "None" && accessModule !== "None") {
                        show = false;
                    } else if (module !== "None" && accessModule !== "All" && !accessModule.includes(module)) {
                        show = false;
                    }
                }

                option.style.display = show ? '' : 'none';
                option.disabled = !show;
            }
        }

        // Update access description
        function updateAccessDescription() {
            const accessSelect = document.getElementById("hrmsAccess");
            const selectedOption = accessSelect.options[accessSelect.selectedIndex];
            const description = document.getElementById("accessDescription");

            if (selectedOption && selectedOption.value) {
                const accessDesc = selectedOption.getAttribute('data-description');
                const accessModules = selectedOption.getAttribute('data-module');

                let moduleText = "";
                if (accessModules === "All") {
                    moduleText = "All modules";
                } else if (accessModules === "None") {
                    moduleText = "No module access";
                } else {
                    moduleText = `Modules: ${accessModules}`;
                }

                description.textContent = `${accessDesc}. ${moduleText}`;

                // Update module checkboxes based on access level
                updateModuleCheckboxes(accessModules);
            } else {
                description.textContent = "";
            }
        }

        // Update module checkboxes based on access level
        function updateModuleCheckboxes(modules) {
            const checkboxes = document.querySelectorAll('input[name="module"]');

            if (modules === "All") {
                checkboxes.forEach(cb => cb.checked = true);
            } else if (modules === "None") {
                checkboxes.forEach(cb => cb.checked = false);
            } else {
                const moduleList = modules.split(",");
                checkboxes.forEach(cb => {
                    cb.checked = moduleList.includes(cb.value);
                });
            }
        }

        // Update sub-departments based on department
        function updateSubDepartments(dept) {
            const subDeptSelect = document.getElementById("subDepartment");

            // Clear existing options except the first one
            while (subDeptSelect.options.length > 1) {
                subDeptSelect.remove(1);
            }

            // Define sub-departments for each department
            const subDepartments = {
                "Retail": ["Fashion", "Electronics", "Home & Living", "Grocery", "Beauty & Health"],
                "Security": ["Surveillance", "Access Control", "Patrolling", "Emergency Response"],
                "Housekeeping": ["Cleaning", "Waste Management", "Pest Control", "Laundry"],
                "Technical": ["Electrical", "Plumbing", "HVAC", "Elevator", "General Maintenance"],
                "FoodCourt": ["Kitchen", "Service", "Cleaning", "Inventory", "Quality Control"],
                "Admin": ["HR", "Finance", "Administration", "Procurement"],
                "CustomerSupport": ["Information Desk", "Complaints", "Lost & Found", "Feedback"]
            };

            if (dept && subDepartments[dept]) {
                subDepartments[dept].forEach(sub => {
                    const option = document.createElement("option");
                    option.value = sub;
                    option.textContent = sub;
                    subDeptSelect.appendChild(option);
                });
            }
        }

        // Update reporting managers based on department
        function updateReportingManagers(dept) {
            const managerSelect = document.getElementById("reportingManager");

            // Clear existing options except the first one
            while (managerSelect.options.length > 1) {
                managerSelect.remove(1);
            }

            // Define managers for each department
            const managers = {
                "Admin": ["John Smith (Mall Manager)", "Priya Sharma (HR Manager)",
                    "Robert Johnson (Accounts Manager)"],
                "Retail": ["Sarah Williams (Retail Manager)", "David Brown (Floor Manager)",
                    "Lisa Taylor (Store Manager)"
                ],
                "Security": ["Michael Wilson (Security Head)", "James Anderson (Security Supervisor)",
                    "Emma Thompson (Shift Incharge)"
                ],
                "Housekeeping": ["Maria Garcia (Housekeeping Head)", "Thomas Martin (Supervisor)",
                    "Sophia Clark (Area Incharge)"
                ],
                "Technical": ["Daniel Lewis (Technical Head)", "Olivia Walker (Maintenance Manager)",
                    "Andrew Hall (Shift Engineer)"
                ],
                "Parking": ["Kevin Scott (Parking Manager)", "Jennifer Adams (Parking Supervisor)",
                    "Richard King (Shift Incharge)"
                ],
                "FoodCourt": ["Susan Wright (Food Court Manager)", "Paul Lopez (Kitchen Head)",
                    "Karen Hill (Service Manager)"
                ],
                "CustomerSupport": ["Brian Green (Customer Service Head)", "Nancy Baker (Team Lead)",
                    "Mark Carter (Shift Incharge)"
                ],
                "Finance": ["Jessica Perez (Finance Manager)", "Steven Roberts (Accounts Head)"],
                "Marketing": ["Amanda Turner (Marketing Head)", "Jason Phillips (Marketing Manager)"],
                "IT": ["Rebecca Campbell (IT Manager)", "Timothy Parker (System Admin)"],
                "HR": ["Priya Sharma (HR Manager)", "Rebecca Campbell (Recruitment Head)"]
            };

            if (dept && managers[dept]) {
                managers[dept].forEach(manager => {
                    const option = document.createElement("option");
                    option.value = manager;
                    option.textContent = manager;
                    managerSelect.appendChild(option);
                });
            }
        }

        // Calculate age from date of birth
        function calculateAge() {
            const dob = document.getElementById("dob").value;
            if (dob) {
                const birthDate = new Date(dob);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                document.getElementById("age").value = age + " years";
            }
        }

        // Update date calculations
        function updateDateCalculations() {
            const joiningDate = document.getElementById("joiningDate").value;
            const empType = document.getElementById("employeeType").value;

            if (joiningDate) {
                const joinDate = new Date(joiningDate);
                const today = new Date();

                // Calculate days until joining
                const timeDiff = joinDate.getTime() - today.getTime();
                const daysUntilJoin = Math.ceil(timeDiff / (1000 * 3600 * 24));

                // Update probation end date
                updateProbationEndDate();

                // Calculate contract end date based on employee type
                if (empType === "Contract") {
                    const contractEnd = new Date(joinDate);
                    contractEnd.setMonth(contractEnd.getMonth() + 12); // 1 year contract
                    document.getElementById("contractEndDate").value = contractEnd.toISOString().split('T')[0];
                    calculateContractDuration();
                } else if (empType === "Temporary") {
                    const contractEnd = new Date(joinDate);
                    contractEnd.setMonth(contractEnd.getMonth() + 6); // 6 months contract
                    document.getElementById("contractEndDate").value = contractEnd.toISOString().split('T')[0];
                    calculateContractDuration();
                }

                // Update date calculation display
                let message = "";
                if (daysUntilJoin > 0) {
                    message = `Joining in ${daysUntilJoin} days`;
                } else if (daysUntilJoin === 0) {
                    message = "Joining today";
                } else {
                    message = `Joined ${Math.abs(daysUntilJoin)} days ago`;
                }

                document.getElementById("dateCalculation").innerHTML = message;
            }
        }

        // Update probation end date
        function updateProbationEndDate() {
            const joiningDate = document.getElementById("joiningDate").value;
            const probationMonths = parseInt(document.getElementById("probationPeriod").value);

            if (joiningDate && probationMonths > 0) {
                const joinDate = new Date(joiningDate);
                const probationEnd = new Date(joinDate);
                probationEnd.setMonth(probationEnd.getMonth() + probationMonths);
                document.getElementById("probationEndDate").value = probationEnd.toISOString().split('T')[0];
            } else {
                document.getElementById("probationEndDate").value = "";
            }
        }

        // Calculate contract duration
        function calculateContractDuration() {
            const startDate = document.getElementById("joiningDate").value;
            const endDate = document.getElementById("contractEndDate").value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const timeDiff = end.getTime() - start.getTime();
                const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                const monthsDiff = Math.floor(daysDiff / 30);

                if (daysDiff > 0) {
                    const calculationDiv = document.getElementById("dateCalculation");
                    const existingMsg = calculationDiv.innerHTML;
                    calculationDiv.innerHTML =
                    `${existingMsg} | Contract Duration: ${monthsDiff} months (${daysDiff} days)`;
                }
            }
        }

        // Set default dates
        function setDefaultDates() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById("joiningDate").value = today;
            document.getElementById("joiningDate").min = today;

            // Set max date for DOB (18 years ago)
            const maxDobDate = new Date();
            maxDobDate.setFullYear(maxDobDate.getFullYear() - 18);
            document.getElementById("dob").max = maxDobDate.toISOString().split('T')[0];

            // Set min date for DOB (65 years ago)
            const minDobDate = new Date();
            minDobDate.setFullYear(minDobDate.getFullYear() - 65);
            document.getElementById("dob").min = minDobDate.toISOString().split('T')[0];

            // Set default DOB (25 years ago)
            const defaultDobDate = new Date();
            defaultDobDate.setFullYear(defaultDobDate.getFullYear() - 25);
            document.getElementById("dob").value = defaultDobDate.toISOString().split('T')[0];

            // Set access expiry date (1 year from today)
            const expiryDate = new Date();
            expiryDate.setFullYear(expiryDate.getFullYear() + 1);
            document.getElementById("accessExpiry").value = expiryDate.toISOString().split('T')[0];

            // Calculate age
            calculateAge();
        }

        // Update salary range based on designation
        function updateSalaryRange() {
            const designationSelect = document.getElementById("designation");
            const selectedOption = designationSelect.options[designationSelect.selectedIndex];
            const detailsDiv = document.getElementById("designationDetails");

            if (selectedOption && selectedOption.value) {
                const minSalary = selectedOption.getAttribute('data-min-salary');
                const maxSalary = selectedOption.getAttribute('data-max-salary');

                // Set the salary amount to the midpoint
                const midSalary = Math.round((parseInt(minSalary) + parseInt(maxSalary)) / 2);
                document.getElementById("salaryAmount").value = midSalary;

                // Update designation details
                detailsDiv.textContent =
                    `Salary Range: ₹${parseInt(minSalary).toLocaleString()} - ₹${parseInt(maxSalary).toLocaleString()}`;

                // Update salary preview
                updateSalaryPreview();
            } else {
                detailsDiv.textContent = "";
            }
        }

        // Update salary preview
        function updateSalaryPreview() {
            const salary = parseFloat(document.getElementById("salaryAmount").value) || 0;
            const salaryType = document.getElementById("salaryType").value;
            const shift = document.getElementById("shift").value;

            if (salary > 0 && salaryType) {
                // Calculate components based on salary type
                let basic, hra, conveyance, shiftAllowance, medical, pf;

                if (salaryType === 'Monthly') {
                    basic = salary * 0.5; // 50% basic
                    hra = basic * 0.4; // 40% of basic
                    conveyance = 1600; // Fixed conveyance
                    medical = 1250; // Fixed medical
                } else if (salaryType === 'Daily') {
                    basic = salary * 26 * 0.5; // Assuming 26 working days
                    hra = basic * 0.4;
                    conveyance = 1600;
                    medical = 1250;
                } else if (salaryType === 'Hourly') {
                    basic = salary * 8 * 26 * 0.5; // 8 hours/day, 26 days
                    hra = basic * 0.4;
                    conveyance = 1600;
                    medical = 1250;
                } else {
                    basic = salary;
                    hra = 0;
                    conveyance = 0;
                    medical = 0;
                }

                // Shift allowance
                if (shift === 'Night') {
                    shiftAllowance = 2000;
                } else if (shift === 'Evening') {
                    shiftAllowance = 1000;
                } else if (shift === 'Rotational') {
                    shiftAllowance = 1500;
                } else {
                    shiftAllowance = 0;
                }

                // PF calculation (12% of basic)
                pf = basic * 0.12;

                const total = basic + hra + conveyance + shiftAllowance + medical - pf;

                // Update preview
                document.getElementById('previewBasic').textContent = '₹' + Math.round(basic).toLocaleString();
                document.getElementById('previewHRA').textContent = '₹' + Math.round(hra).toLocaleString();
                document.getElementById('previewConveyance').textContent = '₹' + Math.round(conveyance).toLocaleString();
                document.getElementById('previewShift').textContent = '₹' + Math.round(shiftAllowance).toLocaleString();
                document.getElementById('previewMedical').textContent = '₹' + Math.round(medical).toLocaleString();
                document.getElementById('previewPF').textContent = '₹' + Math.round(pf).toLocaleString();
                document.getElementById('previewTotal').textContent = '₹' + Math.round(total).toLocaleString();

                // Show preview
                document.getElementById('salaryPreview').style.display = 'block';
            } else {
                document.getElementById('salaryPreview').style.display = 'none';
            }
        }

        // Update shift allowance in preview
        function updateShiftAllowance() {
            updateSalaryPreview();
        }

        // Update work area details
        function updateWorkAreaDetails() {
            // Could add specific details based on work area
            const workArea = document.getElementById("workArea").value;
            // console.log("Work area selected: " + workArea);
        }

        // Update manager details
        function updateManagerDetails() {
            const managerSelect = document.getElementById("reportingManager");
            const selectedOption = managerSelect.options[managerSelect.selectedIndex];
            const detailsDiv = document.getElementById("managerDetails");

            if (selectedOption && selectedOption.value) {
                detailsDiv.textContent = "Reporting to: " + selectedOption.value;
            } else {
                detailsDiv.textContent = "";
            }
        }

        // Handle file upload
        function handleFileUpload() {
            const fileInput = document.getElementById("fileUpload");
            const uploadedFilesDiv = document.getElementById("uploadedFiles");

            if (fileInput.files.length > 0) {
                for (let i = 0; i < fileInput.files.length; i++) {
                    const file = fileInput.files[i];

                    // Create file item
                    const fileItem = document.createElement("div");
                    fileItem.className = "file-item";

                    const fileInfo = document.createElement("div");
                    fileInfo.className = "file-info";

                    const fileIcon = document.createElement("i");
                    fileIcon.className = "fas fa-file file-icon";

                    const fileName = document.createElement("span");
                    fileName.textContent = file.name + " (" + formatFileSize(file.size) + ")";

                    const fileRemove = document.createElement("i");
                    fileRemove.className = "fas fa-times file-remove";
                    fileRemove.title = "Remove file";
                    fileRemove.onclick = function() {
                        fileItem.remove();
                    };

                    fileInfo.appendChild(fileIcon);
                    fileInfo.appendChild(fileName);
                    fileItem.appendChild(fileInfo);
                    fileItem.appendChild(fileRemove);

                    uploadedFilesDiv.appendChild(fileItem);
                }

                // Reset file input
                fileInput.value = "";
            }
        }

        // Format file size
        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + " bytes";
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + " KB";
            else return (bytes / 1048576).toFixed(1) + " MB";
        }

        // Update districts based on selected state
        function updateDistricts() {
            const state = document.getElementById("state").value;
            const districtInput = document.getElementById("district");

            if (state && stateDistricts[state]) {
                // Create a datalist for district suggestions
                let datalist = document.getElementById("districtList");
                if (!datalist) {
                    datalist = document.createElement("datalist");
                    datalist.id = "districtList";
                    document.body.appendChild(datalist);
                }

                // Clear existing options
                datalist.innerHTML = '';

                // Add new options
                stateDistricts[state].forEach(district => {
                    const option = document.createElement("option");
                    option.value = district;
                    datalist.appendChild(option);
                });

                // Link datalist to input
                districtInput.setAttribute("list", "districtList");
            } else {
                districtInput.removeAttribute("list");
            }
        }

        // Preview form data
        function previewForm() {
            // Collect form data
            const formData = {
                employeeType: document.getElementById("employeeType").value,
                fullName: document.getElementById("fullName").value,
                mobile: document.getElementById("mobile").value,
                email: document.getElementById("email").value,
                dob: document.getElementById("dob").value,
                age: document.getElementById("age").value,
                joiningDate: document.getElementById("joiningDate").value,
                department: document.getElementById("department").value,
                designation: document.getElementById("designation").value,
                hrmsAccess: document.getElementById("hrmsAccess").value,
                salaryType: document.getElementById("salaryType").value,
                salaryAmount: document.getElementById("salaryAmount").value
            };

            // Create preview message
            let previewMessage = `<strong>Form Preview</strong><br><br>`;
            previewMessage += `<strong>Employee:</strong> ${formData.fullName}<br>`;
            previewMessage += `<strong>Employee Type:</strong> ${formData.employeeType}<br>`;
            previewMessage += `<strong>Date of Joining:</strong> ${formData.joiningDate}<br>`;
            previewMessage += `<strong>Department:</strong> ${formData.department}<br>`;
            previewMessage += `<strong>Designation:</strong> ${formData.designation}<br>`;
            previewMessage += `<strong>HRMS Access:</strong> ${formData.hrmsAccess}<br>`;
            previewMessage += `<strong>Salary:</strong> ₹${formData.salaryAmount} (${formData.salaryType})<br>`;
            previewMessage += `<strong>Contact:</strong> ${formData.mobile} | ${formData.email}<br><br>`;
            previewMessage += `Please review the information before submitting.`;

            showMessage(previewMessage, "info");
        }

        // Show status messages
        function showMessage(message, type) {
            const statusDiv = document.getElementById("statusMessage");
            statusDiv.innerHTML = message;
            statusDiv.className = `status-message ${type}`;
            statusDiv.style.display = "block";

            // Scroll to top to show message
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            // Auto-hide after 8 seconds for info/success messages
            if (type === "success" || type === "info") {
                setTimeout(() => {
                    statusDiv.style.display = "none";
                }, 8000);
            }
        }

        document.getElementById("onboardingForm").addEventListener("submit", function(e) {
            e.preventDefault();

            // --- your existing validation same as it is ---
            const requiredFields = document.querySelectorAll('[required]');
            let isValid = true;
            let errorMessage = "";

            requiredFields.forEach(field => {
                if (field.type === 'checkbox') {
                    if (!field.checked) {
                        field.parentElement.style.color = "#e74c3c";
                        isValid = false;
                        errorMessage = "Please check all required document checkboxes";
                    } else {
                        field.parentElement.style.color = "";
                    }
                } else if (!field.value.trim()) {
                    field.style.borderColor = "#e74c3c";
                    isValid = false;
                    errorMessage = "Please fill in all required fields";
                } else {
                    field.style.borderColor = "#d1d9e6";
                }
            });

            const pan = document.getElementById("pan").value;
            const panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            if (pan && !panPattern.test(pan)) {
                document.getElementById("pan").style.borderColor = "#e74c3c";
                isValid = false;
                errorMessage = "Please enter a valid PAN number (Format: ABCDE1234F)";
            }

            const aadhaar = document.getElementById("aadhaar").value;
            const aadhaarPattern = /^[0-9]{12}$/;
            if (aadhaar && !aadhaarPattern.test(aadhaar)) {
                document.getElementById("aadhaar").style.borderColor = "#e74c3c";
                isValid = false;
                errorMessage = "Please enter a valid 12-digit Aadhaar number";
            }

            if (!isValid) {
                showMessage(errorMessage, "error");
                return;
            }

            // ✅ Collect form data
            const formData = {
                employeeId: document.getElementById("employee_id").value,
                employeeType: document.getElementById("employeeType").value,
                fullName: document.getElementById("fullName").value,
                mobile: document.getElementById("mobile").value,
                email: document.getElementById("email").value,
                aadhaar: document.getElementById("aadhaar").value,
                pan: document.getElementById("pan").value,
                dob: document.getElementById("dob").value,
                age: document.getElementById("age").value,

                joiningDate: document.getElementById("joiningDate").value,
                contractEndDate: document.getElementById("contractEndDate").value,
                probationEndDate: document.getElementById("probationEndDate").value,
                probationPeriod: document.getElementById("probationPeriod").value,

                gender: document.getElementById("gender").value,
                bloodGroup: document.getElementById("bloodGroup").value,

                address: document.getElementById("address").value,
                district: document.getElementById("district").value,
                state: document.getElementById("state").value,
                pincode: document.getElementById("pincode").value,
                maritalStatus: document.getElementById("maritalStatus").value,

                emergencyName: document.getElementById("emergencyName").value,
                emergencyPhone: document.getElementById("emergencyPhone").value,
                emergencyRelation: document.getElementById("emergencyRelation").value,

                deptCategory: document.getElementById("deptCategory").value,
                deptSize: document.getElementById("deptSize").value,
                deptLocation: document.getElementById("deptLocation").value,

                department: document.getElementById("department").value,
                designation: document.getElementById("designation").value,
                subDepartment: document.getElementById("subDepartment").value,
                team: document.getElementById("team").value,

                workArea: document.getElementById("workArea").value,
                shift: document.getElementById("shift").value,
                reportingManager: document.getElementById("reportingManager").value,

                accessLevel: document.getElementById("accessLevel").value,
                accessDepartment: document.getElementById("accessDepartment").value,
                accessModule: document.getElementById("accessModule").value,

                hrmsAccess: document.getElementById("hrmsAccess").value,
                accessExpiry: document.getElementById("accessExpiry").value,

                salaryType: document.getElementById("salaryType").value,
                salaryAmount: document.getElementById("salaryAmount").value,
                paymentMode: document.getElementById("paymentMode").value,
                paymentDate: document.getElementById("paymentDate").value,

                bankName: document.getElementById("bankName").value,
                accountNumber: document.getElementById("accountNumber").value,
                ifscCode: document.getElementById("ifscCode").value,
                uanNumber: document.getElementById("uanNumber").value,

                additionalNotes: document.getElementById("additionalNotes").value,
            };

            // ✅ HRMS Modules
            const hrmsModules = [];
            document.querySelectorAll('.checkbox-group input[type="checkbox"]').forEach(cb => {
                // only module checkboxes (id starts with module)
                if (cb.id.startsWith('module') && cb.checked) hrmsModules.push(cb.value);
            });
            formData.hrmsModules = hrmsModules;

            // ✅ Documents checklist (doc checkboxes)
            const documents = [];
            document.querySelectorAll('input[id^="doc"]:checked').forEach(cb => documents.push(cb.value));
            formData.documents = documents;

            // ✅ AJAX to Laravel
            fetch("{{ url('/employee-onboarding/store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content")
                    },
                    body: JSON.stringify(formData)
                })
                .then(async (res) => {
                    const data = await res.json();
                    if (!res.ok) throw data;
                    return data;
                })
                .then((resp) => {
                    showMessage(`<strong>Employee Onboarding Successful!</strong><br><br>
      Employee ID: <span class="highlight">${resp.employee_id}</span><br>
      Name: <span class="highlight">${resp.data.fullName}</span><br>
      Designation: <span class="highlight">${resp.data.designation}</span><br>
      Department: <span class="highlight">${resp.data.department}</span><br>
      Joining Date: <span class="highlight">${resp.data.joiningDate}</span><br><br>
      An email with login credentials has been sent to ${resp.data.email}`, "success");

                    setTimeout(() => resetForm(), 8000);
                })
                .catch((err) => {
                    // Laravel validation errors
                    if (err && err.errors) {
                        const firstKey = Object.keys(err.errors)[0];
                        showMessage(err.errors[firstKey][0], "error");
                        return;
                    }
                    showMessage("Server error. Please try again.", "error");
                    console.error(err);
                });
        });


        // Reset form function
        function resetForm() {
            document.getElementById("onboardingForm").reset();

            // Reset department dropdown
            const deptSelect = document.getElementById("department");
            deptSelect.selectedIndex = 0;
            document.getElementById("departmentDetails").style.display = "none";

            // Reset designation dropdown
            const designationSelect = document.getElementById("designation");
            while (designationSelect.options.length > 1) {
                designationSelect.remove(1);
            }

            // Reset uploaded files
            document.getElementById("uploadedFiles").innerHTML = "";

            // Clear any validation styling
            const fields = document.querySelectorAll('input, select, textarea');
            fields.forEach(field => {
                field.style.borderColor = "#d1d9e6";
                if (field.type === 'checkbox') {
                    field.parentElement.style.color = "";
                }
            });

            // Reset filters
            document.getElementById("deptCategory").value = "";
            document.getElementById("deptSize").value = "";
            document.getElementById("deptLocation").value = "";
            document.getElementById("accessLevel").value = "";
            document.getElementById("accessDepartment").value = "";
            document.getElementById("accessModule").value = "";

            // Reset access description
            document.getElementById("accessDescription").textContent = "";

            // Hide status message
            document.getElementById("statusMessage").style.display = "none";

            // Hide salary preview
            document.getElementById("salaryPreview").style.display = "none";

            // Reset date fields
            setDefaultDates();

            showMessage("Form has been reset. You can now fill in new employee details.", "success");
        }
    </script>
</body>

</html>
