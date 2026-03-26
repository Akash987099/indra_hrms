<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Details · {{ $employeedata->empName ?? 'Employee' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, system-ui, sans-serif;
        }

        body {
            background: #eef2f7;
            padding: 2rem 1rem;
            display: flex;
            justify-content: center;
        }

        .container {
            max-width: 1300px;
            width: 100%;
            background: white;
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 2rem 2rem 2.5rem;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 600;
            color: #0a2b3c;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
            border-left: 8px solid #2b6f9b;
            padding-left: 1.5rem;
        }

        .subhead {
            color: #4a5c6b;
            margin: 0 0 2rem 2.2rem;
            font-size: 1rem;
        }

        fieldset {
            border: 1px solid #d8e2ec;
            border-radius: 1.5rem;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            background: #fafcff;
        }

        legend {
            font-size: 1.3rem;
            font-weight: 600;
            background: white;
            padding: 0.3rem 1.2rem;
            border-radius: 40px;
            border: 1px solid #cbd5e1;
            color: #1e4b6e;
            margin-left: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem 2rem;
            margin-top: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .full-width {
            grid-column: span 2;
        }

        label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1e3b4f;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        label i {
            color: #b22234;
            font-size: 0.8rem;
        }

        input, select, textarea {
            padding: 0.7rem 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 0.95rem;
            transition: all 0.15s;
            background: white;
            width: 100%;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #2b6f9b;
            outline: none;
            box-shadow: 0 0 0 4px rgba(43, 111, 155, 0.12);
        }

        input[type="file"] {
            padding: 0.4rem 0.5rem;
            border-radius: 40px;
            background: #f1f9ff;
        }

        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            align-items: center;
            background: #f2f6fa;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            border: 1px solid #dae2ed;
        }

        .radio-group label {
            font-weight: 500;
            gap: 0.3rem;
            color: #1f3a4b;
            font-size: 0.95rem;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 0.2rem;
            accent-color: #1e6b9b;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0.5rem 0;
        }

        .checkbox-group input {
            width: auto;
            margin-right: 0.3rem;
        }

        .address-utility {
            background: #e7f0f9;
            border-radius: 20px;
            padding: 0.5rem 1.2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }

        /* compensation table */
        .comp-table-wrapper {
            overflow-x: auto;
            margin-top: 2rem;
            border-radius: 20px;
            border: 1px solid #dde5ed;
            background: #ffffff;
        }

        .comp-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            min-width: 550px;
        }

        .comp-table th {
            background: #1f4662;
            color: white;
            font-weight: 600;
            padding: 0.9rem 1rem;
            text-align: left;
        }

        .comp-table th:first-child {
            border-top-left-radius: 18px;
        }
        .comp-table th:last-child {
            border-top-right-radius: 18px;
        }

        .comp-table td {
            padding: 0.7rem 1rem;
            border-bottom: 1px solid #e2eaf2;
        }

        .comp-table tr:last-child td {
            border-bottom: none;
        }

        .comp-table td:first-child {
            font-weight: 500;
            color: #153e54;
            background-color: #f9fcff;
            width: 40%;
        }

        .comp-table input {
            width: 140px;
            padding: 0.5rem 0.8rem;
            border-radius: 30px;
            border: 1.5px solid #cbdae8;
            background: white;
            font-size: 0.9rem;
        }

        .comp-table input:focus {
            border-color: #1a6b9f;
        }

        .comp-table input[readonly] {
            background-color: #edf3f9;
            border-color: #c0d0df;
            color: #1a4058;
            font-weight: 500;
        }

        .section-header td {
            background-color: #e6f0f9;
            font-weight: 700;
            color: #003153;
            letter-spacing: 0.3px;
        }

        .section-header td:first-child {
            background-color: #e6f0f9;
        }

        .form-actions {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin: 2.5rem 0 1rem;
        }

        button {
            background: #1a4b6d;
            color: white;
            border: none;
            padding: 1rem 3rem;
            border-radius: 60px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 8px 14px -8px #0b3144;
            border: 1px solid #ffffff30;
        }

        button[type="reset"] {
            background: #e1e9f1;
            color: #1e3b4f;
            box-shadow: none;
        }

        button:hover {
            background: #0f3b57;
            transform: scale(1.02);
        }

        button[type="reset"]:hover {
            background: #ccd9e6;
        }

        .feedback {
            text-align: center;
            padding: 1rem;
            font-weight: 500;
            border-radius: 40px;
            background: #f8fafd;
            color: #153e54;
        }

        .feedback.error {
            background: #ffe8e8;
            color: #a41c1c;
        }

        .feedback.success {
            background: #dff0dd;
            color: #1d6b2b;
        }

        hr {
            border: 1px dashed #cbd5e1;
            margin: 1.5rem 0 0.5rem;
        }

        @media (max-width: 700px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .full-width {
                grid-column: span 1;
            }
            fieldset {
                padding: 1.2rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>📋 EDIT EMPLOYEE DETAILS</h1>
    <div class="subhead">Editing onboarding information for {{ $employeedata->empName ?? 'Employee' }} (ID: {{ $employeedata->empId ?? 'N/A' }})</div>

    @if(session('success'))
        <div class="feedback success" style="margin-bottom: 20px;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="feedback error" style="margin-bottom: 20px;">{{ session('error') }}</div>
    @endif

    <form id="onboardingForm" action="{{ route('employee.update_on') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <input type="hidden" name="employee_record_id" value="{{ old('employee_record_id', $employeedata->employee_record_id ?? $employee->id) }}">
        <input type="hidden" name="onboarding_record_id" value="{{ old('onboarding_record_id', $employeedata->onboarding_record_id ?? '') }}">
        <!-- 1. BASIC DETAILS (same as before) -->
        <fieldset>
            <legend>1. Basic details</legend>
            <div class="form-grid">
                <div class="form-group"><label>Employee ID <i>*</i></label><input type="text" name="empId" id="empId" placeholder="e.g. EMP-1234" required value="{{ old('empId', $employeedata->empId ?? '') }}"></div>
                <div class="form-group"><label>Employee name <i>*</i></label><input type="text" name="empName" id="empName" placeholder="Full name" required value="{{ old('empName', $employeedata->empName ?? '') }}"></div>
                <div class="form-group"><label>Father’s / Husband’s name</label><input type="text" name="fatherName" placeholder="Father or spouse name" value="{{ old('fatherName', $employeedata->fatherName ?? '') }}"></div>
                <div class="form-group"><label>Date of birth <i>*</i></label><input type="date" name="dob" id="dob" required value="{{ old('dob', $employeedata->dob ?? '') }}"></div>
                <div class="form-group"><label>Gender <i>*</i></label>
                    <div class="radio-group" id="genderGroup">
                        <label><input type="radio" name="gender" value="Male" required {{ old('gender', $employeedata->gender ?? '') == 'Male' ? 'checked' : '' }}> Male</label>
                        <label><input type="radio" name="gender" value="Female" {{ old('gender', $employeedata->gender ?? '') == 'Female' ? 'checked' : '' }}> Female</label>
                        <label><input type="radio" name="gender" value="Other" {{ old('gender', $employeedata->gender ?? '') == 'Other' ? 'checked' : '' }}> Other</label>
                    </div>
                </div>
                <div class="form-group"><label>Mobile number <i>*</i></label><input type="tel" name="mobile" id="mobile" placeholder="9876543210" required value="{{ old('mobile', $employeedata->mobile ?? '') }}"></div>
                <div class="form-group"><label>Email ID <i>*</i></label><input type="email" name="email" id="email" placeholder="employee@company.com" required value="{{ old('email', $employeedata->email ?? '') }}"></div>
                <div class="form-group"><label>Marital status</label>
                    <select name="maritalStatus">
                        <option value="">-- select --</option>
                        <option @if(old('maritalStatus', $employeedata->maritalStatus ?? '') == 'Single') selected @endif>Single</option>
                        <option @if(old('maritalStatus', $employeedata->maritalStatus ?? '') == 'Married') selected @endif>Married</option>
                        <option @if(old('maritalStatus', $employeedata->maritalStatus ?? '') == 'Divorced') selected @endif>Divorced</option>
                        <option @if(old('maritalStatus', $employeedata->maritalStatus ?? '') == 'Widowed') selected @endif>Widowed</option>
                    </select>
                </div>
                <div class="form-group"><label>Blood group</label>
                    <select name="bloodGroup">
                        <option value="">-- select --</option>
                        <option @if(old('bloodGroup', $employeedata->bloodGroup ?? '') == 'A+') selected @endif>A+</option><option @if(old('bloodGroup', $employeedata->bloodGroup ?? '') == 'A-') selected @endif>A-</option><option @if(old('bloodGroup', $employeedata->bloodGroup ?? '') == 'B+') selected @endif>B+</option><option @if(old('bloodGroup', $employeedata->bloodGroup ?? '') == 'B-') selected @endif>B-</option>
                        <option @if(old('bloodGroup', $employeedata->bloodGroup ?? '') == 'O+') selected @endif>O+</option><option @if(old('bloodGroup', $employeedata->bloodGroup ?? '') == 'O-') selected @endif>O-</option><option @if(old('bloodGroup', $employeedata->bloodGroup ?? '') == 'AB+') selected @endif>AB+</option><option @if(old('bloodGroup', $employeedata->bloodGroup ?? '') == 'AB-') selected @endif>AB-</option>
                    </select>
                </div>
                <div class="form-group full-width"><label>Photograph</label><input type="file" name="photo" accept="image/*"></div>
            </div>
        </fieldset>

        <!-- 2. ADDRESS DETAILS (same) -->
        <fieldset>
            <legend>2. Address details</legend>
            <div class="address-utility">
                <input type="checkbox" id="sameAsCurrent"> 
                <label for="sameAsCurrent" style="font-weight:500; color:#0c344b;">🔁 Same as Current Address (copies to permanent)</label>
            </div>
            <div class="form-grid">
                <div class="form-group full-width"><label>Current address</label><textarea name="currentAddress" id="currentAddress" rows="2" placeholder="Street, locality ...">{{ old('currentAddress', $employeedata->currentAddress ?? '') }}</textarea></div>
                <div class="form-group full-width"><label>Permanent address</label><textarea name="permanentAddress" id="permanentAddress" rows="2" placeholder="Full permanent address">{{ old('permanentAddress', $employeedata->permanentAddress ?? '') }}</textarea></div>
                <div class="form-group"><label>City</label><input type="text" name="city" placeholder="e.g. Mumbai" value="{{ old('city', $employeedata->city ?? '') }}"></div>
                <div class="form-group"><label>State</label><input type="text" name="state" placeholder="Maharashtra" value="{{ old('state', $employeedata->state ?? '') }}"></div>
                <div class="form-group full-width"><label>PIN code</label><input type="text" name="pinCode" placeholder="400001" value="{{ old('pinCode', $employeedata->pinCode ?? '') }}"></div>
            </div>
        </fieldset>

        <!-- 3. JOB DETAILS (same) -->
        <fieldset>
            <legend>3. Job details</legend>
            <div class="form-grid">
                <div class="form-group"><label>Department</label><input type="text" name="department" placeholder="Engineering / Sales" value="{{ old('department', $employeedata->department ?? '') }}"></div>
                <div class="form-group"><label>Designation</label><input type="text" name="designation" placeholder="Software Engineer" value="{{ old('designation', $employeedata->designation ?? '') }}"></div>
                <div class="form-group"><label>Work location / Branch</label><input type="text" name="workLocation" placeholder="Pune office" value="{{ old('workLocation', $employeedata->workLocation ?? '') }}"></div>
                <div class="form-group"><label>Date of joining</label><input type="date" name="doj" value="{{ old('doj', $employeedata->doj ?? '') }}"></div>
                <div class="form-group"><label>Employment type</label>
                    <select name="employmentType">
                        <option @if(old('employmentType', $employeedata->employmentType ?? '') == 'Full Time') selected @endif>Full Time</option>
                        <option @if(old('employmentType', $employeedata->employmentType ?? '') == 'Part Time') selected @endif>Part Time</option>
                        <option @if(old('employmentType', $employeedata->employmentType ?? '') == 'Contract') selected @endif>Contract</option>
                    </select>
                </div>
                <div class="form-group"><label>Reporting manager</label><input type="text" name="reportingManager" placeholder="Manager name" value="{{ old('reportingManager', $employeedata->reportingManager ?? '') }}"></div>
                <div class="form-group full-width"><label>Shift timing</label><input type="text" name="shiftTiming" placeholder="e.g. 9am–6pm / rotational" value="{{ old('shiftTiming', $employeedata->shiftTiming ?? '') }}"></div>
            </div>
        </fieldset>

        <!-- 4. SALARY & BANK DETAILS (UPDATED with compensation table) -->
        <fieldset>
            <legend>4. Salary & bank details</legend>
            <div class="form-grid" style="margin-bottom: 1rem;">
                <div class="form-group"><label>Bank name</label><input type="text" name="bankName" placeholder="SBI / HDFC ..." value="{{ old('bankName', $employeedata->bankName ?? '') }}"></div>
                <div class="form-group"><label>Account number</label><input type="text" name="accountNo" placeholder="1234567890" value="{{ old('accountNo', $employeedata->accountNo ?? '') }}"></div>
                <div class="form-group"><label>IFSC code</label><input type="text" name="ifsc" placeholder="SBIN0001234" value="{{ old('ifsc', $employeedata->ifsc ?? '') }}"></div>
                <div class="form-group full-width"><label>UPI ID (optional)</label><input type="text" name="upi" placeholder="name@bank" value="{{ old('upi', $employeedata->upi ?? '') }}"></div>
            </div>

            <!-- Compensation table (monthly / annual) -->
            <div class="comp-table-wrapper">
                <table class="comp-table">
                    <thead>
                        <tr><th>Compensation Structure (INR)</th><th>Monthly</th><th>Annually</th></tr>
                    </thead>
                    <tbody>
                        <!-- base components -->
                        <tr><td>Basic Salary + DA</td>
                            <td><input type="number" step="0.01" name="basicMonthly" id="basicMonthly" value="{{ old('basicMonthly', $employeedata->basicMonthly ?? '0.00') }}"></td>
                            <td><input type="number" step="0.01" name="basicAnnual" id="basicAnnual" readonly class="annual-field"></td>
                        </tr>
                        <tr><td>House Rent Allowance (HRA)</td>
                            <td><input type="number" step="0.01" name="hraMonthly" id="hraMonthly" value="{{ old('hraMonthly', $employeedata->hraMonthly ?? '0.00') }}"></td>
                            <td><input type="number" step="0.01" name="hraAnnual" id="hraAnnual" readonly class="annual-field"></td>
                        </tr>
                        <tr><td>Flexi Pay</td>
                            <td><input type="number" step="0.01" name="flexiMonthly" id="flexiMonthly" value="{{ old('flexiMonthly', $employeedata->flexiMonthly ?? '0.00') }}"></td>
                            <td><input type="number" step="0.01" name="flexiAnnual" id="flexiAnnual" readonly class="annual-field"></td>
                        </tr>
                        <tr><td>Acting Allowance</td>
                            <td><input type="number" step="0.01" name="actingMonthly" id="actingMonthly" value="{{ old('actingMonthly', $employeedata->actingMonthly ?? '0.00') }}"></td>
                            <td><input type="number" step="0.01" name="actingAnnual" id="actingAnnual" readonly class="annual-field"></td>
                        </tr>
                        <!-- Subtotal A -->
                        <tr><td><strong>Sub-Total (A)</strong></td>
                            <td><input type="number" step="0.01" name="subAMonthly" id="subAMonthly" readonly></td>
                            <td><input type="number" step="0.01" name="subAAnnual" id="subAAnnual" readonly></td>
                        </tr>
                        <!-- Retiral & other benefits header -->
                        <tr class="section-header"><td colspan="3">Retiral & Other Benefits</td></tr>
                        <tr><td>Provident Fund (PF)</td>
                            <td><input type="number" step="0.01" name="pfMonthly" id="pfMonthly" value="{{ old('pfMonthly', $employeedata->pfMonthly ?? '0.00') }}"></td>
                            <td><input type="number" step="0.01" name="pfAnnual" id="pfAnnual" readonly class="annual-field"></td>
                        </tr>
                        <tr><td>ESI</td>
                            <td><input type="number" step="0.01" name="esiMonthly" id="esiMonthly" value="{{ old('esiMonthly', $employeedata->esiMonthly ?? '0.00') }}"></td>
                            <td><input type="number" step="0.01" name="esiAnnual" id="esiAnnual" readonly class="annual-field"></td>
                        </tr>
                        <tr><td><strong>Sub-Total (B)</strong></td>
                            <td><input type="number" step="0.01" name="subBMonthly" id="subBMonthly" readonly></td>
                            <td><input type="number" step="0.01" name="subBAnnual" id="subBAnnual" readonly></td>
                        </tr>
                        <!-- Annual Fixed CTC -->
                        <tr><td><strong>Annual Fixed CTC (A)+(B)</strong></td>
                            <td><input type="number" step="0.01" name="fixedCTCMonthly" id="fixedCTCMonthly" readonly></td>
                            <td><input type="number" step="0.01" name="fixedCTCAnnual" id="fixedCTCAnnual" readonly></td>
                        </tr>
                        <!-- Performance linked bonus header -->
                        <tr class="section-header"><td colspan="3">Performance Linked Bonus</td></tr>
                        <tr><td>Annual PLI</td>
                            <td><input type="number" step="0.01" name="pliMonthly" id="pliMonthly" value="{{ old('pliMonthly', $employeedata->pliMonthly ?? '0.00') }}"></td>
                            <td><input type="number" step="0.01" name="pliAnnual" id="pliAnnual" readonly class="annual-field"></td>
                        </tr>
                        <tr><td><strong>Sub-Total (C)</strong></td>
                            <td><input type="number" step="0.01" name="subCMonthly" id="subCMonthly" readonly></td>
                            <td><input type="number" step="0.01" name="subCAnnual" id="subCAnnual" readonly></td>
                        </tr>
                        <!-- GRAND TOTAL -->
                        <tr><td><strong>Annual Total CTC (A)+(B)+(C)</strong></td>
                            <td><input type="number" step="0.01" name="totalCTCMonthly" id="totalCTCMonthly" readonly></td>
                            <td><input type="number" step="0.01" name="totalCTCAnnual" id="totalCTCAnnual" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>

        <!-- 5. GOVERNMENT & COMPLIANCE (same) -->
        <fieldset>
            <legend>5. Government & compliance</legend>
            <div class="form-grid">
                <div class="form-group"><label>Aadhaar number</label><input type="text" name="aadhaar" placeholder="12 digits" maxlength="12" value="{{ old('aadhaar', $employeedata->aadhaar ?? '') }}"></div>
                <div class="form-group"><label>PAN number</label><input type="text" name="pan" placeholder="ABCDE1234F" maxlength="10" value="{{ old('pan', $employeedata->pan ?? '') }}"></div>
                <div class="form-group"><label>PF number</label><input type="text" name="pf" placeholder="PF/12345" value="{{ old('pf', $employeedata->pf ?? '') }}"></div>
                <div class="form-group"><label>ESIC number</label><input type="text" name="esic" placeholder="ESIC/123" value="{{ old('esic', $employeedata->esic ?? '') }}"></div>
                <div class="form-group full-width"><label>UAN number</label><input type="text" name="uan" placeholder="Universal account number" value="{{ old('uan', $employeedata->uan ?? '') }}"></div>
            </div>
        </fieldset>

        <!-- 6. DOCUMENTS SUBMISSION (same) -->
        <fieldset>
            <legend>6. Documents submission</legend>
            <div class="form-grid">
                <div class="form-group"><label>Aadhaar submitted</label><div class="radio-group"><label><input type="radio" name="aadhaarSubmitted" value="Yes" {{ old('aadhaarSubmitted', $employeedata->aadhaarSubmitted ?? '') == 'Yes' ? 'checked' : '' }}> Yes</label><label><input type="radio" name="aadhaarSubmitted" value="No" {{ old('aadhaarSubmitted', $employeedata->aadhaarSubmitted ?? 'No') == 'No' ? 'checked' : '' }}> No</label></div></div>
                <div class="form-group"><label>PAN submitted</label><div class="radio-group"><label><input type="radio" name="panSubmitted" value="Yes" {{ old('panSubmitted', $employeedata->panSubmitted ?? '') == 'Yes' ? 'checked' : '' }}> Yes</label><label><input type="radio" name="panSubmitted" value="No" {{ old('panSubmitted', $employeedata->panSubmitted ?? 'No') == 'No' ? 'checked' : '' }}> No</label></div></div>
                <div class="form-group"><label>Bank passbook / cheque</label><input type="file" name="bankDoc" accept=".pdf,.jpg,.png"></div>
                <div class="form-group"><label>Educational certificates</label><input type="file" name="eduDocs[]" multiple></div>
                <div class="form-group full-width"><label>Experience letter</label><input type="file" name="expLetter"></div>
            </div>
        </fieldset>

        <!-- 7. EMERGENCY CONTACT (same) -->
        <fieldset>
            <legend>7. Emergency contact</legend>
            <div class="form-grid">
                <div class="form-group"><label>Contact name</label><input type="text" name="emergencyName" placeholder="Next of kin" value="{{ old('emergencyName', $employeedata->emergencyName ?? '') }}"></div>
                <div class="form-group"><label>Contact number</label><input type="tel" name="emergencyPhone" placeholder="9876543210" value="{{ old('emergencyPhone', $employeedata->emergencyPhone ?? '') }}"></div>
                <div class="form-group full-width"><label>Relationship</label><input type="text" name="emergencyRelation" placeholder="Spouse / parent / friend" value="{{ old('emergencyRelation', $employeedata->emergencyRelation ?? '') }}"></div>
            </div>
        </fieldset>

        <!-- 8. OTHER HR DETAILS (same) -->
        <fieldset>
            <legend>8. Other HR details</legend>
            <div class="form-grid">
                <div class="form-group"><label>Offer letter issued</label><div class="radio-group"><label><input type="radio" name="offerIssued" value="Yes" {{ old('offerIssued', $employeedata->offerIssued ?? '') == 'Yes' ? 'checked' : '' }}> Yes</label><label><input type="radio" name="offerIssued" value="No" {{ old('offerIssued', $employeedata->offerIssued ?? 'No') == 'No' ? 'checked' : '' }}> No</label></div></div>
                <div class="form-group"><label>Appointment letter issued</label><div class="radio-group"><label><input type="radio" name="appointmentIssued" value="Yes" {{ old('appointmentIssued', $employeedata->appointmentIssued ?? '') == 'Yes' ? 'checked' : '' }}> Yes</label><label><input type="radio" name="appointmentIssued" value="No" {{ old('appointmentIssued', $employeedata->appointmentIssued ?? 'No') == 'No' ? 'checked' : '' }}> No</label></div></div>
                <div class="form-group"><label>ID card issued</label><div class="radio-group"><label><input type="radio" name="idCardIssued" value="Yes" {{ old('idCardIssued', $employeedata->idCardIssued ?? '') == 'Yes' ? 'checked' : '' }}> Yes</label><label><input type="radio" name="idCardIssued" value="No" {{ old('idCardIssued', $employeedata->idCardIssued ?? 'No') == 'No' ? 'checked' : '' }}> No</label></div></div>
                <div class="form-group"><label>Uniform issued</label><div class="radio-group"><label><input type="radio" name="uniformIssued" value="Yes" {{ old('uniformIssued', $employeedata->uniformIssued ?? '') == 'Yes' ? 'checked' : '' }}> Yes</label><label><input type="radio" name="uniformIssued" value="No" {{ old('uniformIssued', $employeedata->uniformIssued ?? 'No') == 'No' ? 'checked' : '' }}> No</label></div></div>
                <div class="form-group full-width"><label>Status</label>
                    <select name="empStatus">
                        <option @if(old('empStatus', $employeedata->empStatus ?? 'Active') == 'Active') selected @endif>Active</option>
                        <option @if(old('empStatus', $employeedata->empStatus ?? '') == 'Left') selected @endif>Left</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <hr>
        <div class="form-actions">
            <button type="submit">✅ UPDATE DETAILS</button>
            <button type="reset">⟲ RESET</button>
        </div>
        <div id="formFeedback" class="feedback">All information is secure — compensation auto-calculated</div>
    </form>
</div>

<script>
    (function() {
        const form = document.getElementById('onboardingForm');
        const feedbackDiv = document.getElementById('formFeedback');

        // ---------- SAME AS CURRENT ADDRESS ----------
        const sameAsCurrentChk = document.getElementById('sameAsCurrent');
        const currentAddr = document.getElementById('currentAddress');
        const permanentAddr = document.getElementById('permanentAddress');

        function copyCurrentToPermanent() {
            if (sameAsCurrentChk.checked) {
                permanentAddr.value = currentAddr.value;
                permanentAddr.readOnly = true;
                permanentAddr.style.background = '#f0f7fc';
            } else {
                permanentAddr.readOnly = false;
                permanentAddr.style.background = 'white';
            }
        }
        sameAsCurrentChk.addEventListener('change', copyCurrentToPermanent);
        currentAddr.addEventListener('input', function() {
            if (sameAsCurrentChk.checked) permanentAddr.value = currentAddr.value;
        });

        // ---------- COMPENSATION AUTO CALCULATION ----------
        // Get all monthly input elements
        const basicMonthly = document.getElementById('basicMonthly');
        const hraMonthly = document.getElementById('hraMonthly');
        const flexiMonthly = document.getElementById('flexiMonthly');
        const actingMonthly = document.getElementById('actingMonthly');
        const pfMonthly = document.getElementById('pfMonthly');
        const esiMonthly = document.getElementById('esiMonthly');
        const pliMonthly = document.getElementById('pliMonthly');

        // Annual readonly fields
        const basicAnnual = document.getElementById('basicAnnual');
        const hraAnnual = document.getElementById('hraAnnual');
        const flexiAnnual = document.getElementById('flexiAnnual');
        const actingAnnual = document.getElementById('actingAnnual');
        const pfAnnual = document.getElementById('pfAnnual');
        const esiAnnual = document.getElementById('esiAnnual');
        const pliAnnual = document.getElementById('pliAnnual');

        // Sub / total fields
        const subAMonthly = document.getElementById('subAMonthly');
        const subAAnnual = document.getElementById('subAAnnual');
        const subBMonthly = document.getElementById('subBMonthly');
        const subBAnnual = document.getElementById('subBAnnual');
        const fixedCTCMonthly = document.getElementById('fixedCTCMonthly');
        const fixedCTCAnnual = document.getElementById('fixedCTCAnnual');
        const subCMonthly = document.getElementById('subCMonthly');
        const subCAnnual = document.getElementById('subCAnnual');
        const totalCTCMonthly = document.getElementById('totalCTCMonthly');
        const totalCTCAnnual = document.getElementById('totalCTCAnnual');

        function updateCompensation() {
            // parse monthly values (default 0 if empty)
            const basic = parseFloat(basicMonthly.value) || 0;
            const hra = parseFloat(hraMonthly.value) || 0;
            const flexi = parseFloat(flexiMonthly.value) || 0;
            const acting = parseFloat(actingMonthly.value) || 0;
            const pf = parseFloat(pfMonthly.value) || 0;
            const esi = parseFloat(esiMonthly.value) || 0;
            const pli = parseFloat(pliMonthly.value) || 0;

            // update annual columns (monthly * 12)
            basicAnnual.value = (basic * 12).toFixed(2);
            hraAnnual.value = (hra * 12).toFixed(2);
            flexiAnnual.value = (flexi * 12).toFixed(2);
            actingAnnual.value = (acting * 12).toFixed(2);
            pfAnnual.value = (pf * 12).toFixed(2);
            esiAnnual.value = (esi * 12).toFixed(2);
            pliAnnual.value = (pli * 12).toFixed(2);

            // Sub-Total (A) = basic+hra+flexi+acting
            const subAMon = basic + hra + flexi + acting;
            const subAAnn = subAMon * 12;
            subAMonthly.value = subAMon.toFixed(2);
            subAAnnual.value = subAAnn.toFixed(2);

            // Sub-Total (B) = pf + esi
            const subBMon = pf + esi;
            const subBAnn = subBMon * 12;
            subBMonthly.value = subBMon.toFixed(2);
            subBAnnual.value = subBAnn.toFixed(2);

            // Annual Fixed CTC = A + B
            const fixedMon = subAMon + subBMon;
            const fixedAnn = fixedMon * 12;
            fixedCTCMonthly.value = fixedMon.toFixed(2);
            fixedCTCAnnual.value = fixedAnn.toFixed(2);

            // Sub-Total (C) = pli (only one component)
            const subCMon = pli;
            const subCAnn = subCMon * 12;
            subCMonthly.value = subCMon.toFixed(2);
            subCAnnual.value = subCAnn.toFixed(2);

            // Total CTC = Fixed CTC + C
            const totalMon = fixedMon + subCMon;
            const totalAnn = totalMon * 12;
            totalCTCMonthly.value = totalMon.toFixed(2);
            totalCTCAnnual.value = totalAnn.toFixed(2);
        }

        // Attach input event to all monthly fields
        const monthlyInputs = [basicMonthly, hraMonthly, flexiMonthly, actingMonthly, pfMonthly, esiMonthly, pliMonthly];
        monthlyInputs.forEach(input => {
            input.addEventListener('input', updateCompensation);
        });

        // initial calculation on page load
        updateCompensation();

        // ---------- FORM VALIDATION (required fields) ----------
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const requiredIds = ['empId', 'empName', 'dob', 'mobile', 'email'];
            let missing = [];
            for (let id of requiredIds) {
                let field = document.getElementById(id);
                if (!field.value.trim()) {
                    missing.push(field.previousElementSibling?.innerText?.replace('*','') || id);
                }
            }

            const genderRadios = document.getElementsByName('gender');
            let genderChecked = false;
            for (let r of genderRadios) if (r.checked) genderChecked = true;
            if (!genderChecked) missing.push('Gender');

            if (missing.length > 0) {
                feedbackDiv.innerHTML = `❌ Missing required fields: ${missing.join(', ')}`;
                feedbackDiv.className = 'feedback error';
                return;
            }

            feedbackDiv.innerHTML = `✅ Submitting... Please wait.`;
            feedbackDiv.className = 'feedback success';
            form.submit();
        });

        form.addEventListener('reset', function() {
            feedbackDiv.innerHTML = 'Form cleared — ready for new entry';
            feedbackDiv.className = 'feedback';
            sameAsCurrentChk.checked = false;
            permanentAddr.readOnly = false;
            permanentAddr.style.background = 'white';
            // compensation will reset to default values because of value attributes, but we need to recalc after reset
            setTimeout(updateCompensation, 10); // small delay to let reset populate defaults
        });
    })();
</script>

<!-- photograph and file inputs are not required -->
</body>
</html>
