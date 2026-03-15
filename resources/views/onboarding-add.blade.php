<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Onboarding · detailed compensation</title>
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
    <h1>📋 EMPLOYEE ONBOARDING</h1>
    <div class="subhead">detailed compensation · auto-calculated totals</div>

    @if(session('success'))
<div style="padding:10px;background:#d4edda;color:#155724;margin-bottom:10px">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="padding:10px;background:#f8d7da;color:#721c24;margin-bottom:10px">
    {{ session('error') }}
</div>
@endif

    {{-- <form id="onboardingForm" novalidate> --}}
        @if(session('success'))

<div style="padding:10px;background:#d4edda;color:#155724;margin-bottom:15px;border-radius:6px;">
    {{ session('success') }}
</div>
@endif

@if(session('error'))

<div style="padding:10px;background:#f8d7da;color:#721c24;margin-bottom:15px;border-radius:6px;">
    {{ session('error') }}
</div>
@endif

<form method="POST" action="{{ route('employee.store_on') }}" enctype="multipart/form-data">
@csrf

<h3>Employee Onboarding</h3>

<!-- BASIC DETAILS -->

<label>Employee ID</label> <input type="text" name="empId" placeholder="EMP001">

<label>Employee Name</label> <input type="text" name="empName">

<label>Father Name</label> <input type="text" name="fatherName">

<label>DOB</label> <input type="date" name="dob">

<label>Gender</label> <br> <input type="radio" name="gender" value="Male"> Male <input type="radio" name="gender" value="Female"> Female <input type="radio" name="gender" value="Other"> Other

<br><br>

<label>Mobile</label> <input type="text" name="mobile">

<label>Email</label> <input type="email" name="email">

<label>Marital Status</label> <select name="maritalStatus">

<option value="">Select</option>
<option>Single</option>
<option>Married</option>
</select>

<label>Blood Group</label> <select name="bloodGroup">

<option value="">Select</option>
<option>A+</option>
<option>B+</option>
<option>O+</option>
<option>AB+</option>
</select>

<label>Photo</label> <input type="file" name="photo">

<hr>

<!-- ADDRESS -->

<h4>Address</h4>

<label>Current Address</label>

<textarea name="currentAddress"></textarea>

<label>Permanent Address</label>

<textarea name="permanentAddress"></textarea>

<label>City</label> <input type="text" name="city">

<label>State</label> <input type="text" name="state">

<label>Pincode</label> <input type="text" name="pinCode">

<hr>

<!-- JOB DETAILS -->

<h4>Job Details</h4>

<label>Department</label> <input type="text" name="department">

<label>Designation</label> <input type="text" name="designation">

<label>Work Location</label> <input type="text" name="workLocation">

<label>Joining Date</label> <input type="date" name="doj">

<label>Reporting Manager</label> <input type="text" name="reportingManager">

<label>Shift</label> <input type="text" name="shiftTiming">

<hr>

<!-- BANK -->

<h4>Bank Details</h4>

<label>Bank Name</label> <input type="text" name="bankName">

<label>Account Number</label> <input type="text" name="accountNo">

<label>IFSC</label> <input type="text" name="ifsc">

<label>UPI</label> <input type="text" name="upi">

<hr>

<!-- SALARY -->

<h4>Salary Structure</h4>

<label>Basic</label> <input type="number" name="basicMonthly" id="basicMonthly">

<label>HRA</label> <input type="number" name="hraMonthly" id="hraMonthly">

<label>Flexi</label> <input type="number" name="flexiMonthly" id="flexiMonthly">

<label>PF</label> <input type="number" name="pfMonthly" id="pfMonthly">

<label>Total CTC Monthly</label> <input type="number" name="totalCTCMonthly" id="totalCTCMonthly">

<label>Total CTC Annual</label> <input type="number" name="totalCTCAnnual" id="totalCTCAnnual">

<hr>

<!-- GOVERNMENT -->

<h4>Government Details</h4>

<label>Aadhaar</label> <input type="text" name="aadhaar">

<label>PAN</label> <input type="text" name="pan">

<label>PF</label> <input type="text" name="pf">

<label>ESIC</label> <input type="text" name="esic">

<label>UAN</label> <input type="text" name="uan">

<hr>

<!-- EMERGENCY -->

<h4>Emergency Contact</h4>

<label>Name</label> <input type="text" name="emergencyName">

<label>Phone</label> <input type="text" name="emergencyPhone">

<label>Relation</label> <input type="text" name="emergencyRelation">

<hr>

<label>Status</label> <select name="empStatus">

<option value="Active">Active</option>
<option value="Left">Left</option>
</select>

<br><br>

<button type="submit">Submit Onboarding</button>

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
            // e.preventDefault();

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

            // collect form data example
            const formData = new FormData(form);
            const data = {};
            for (let [key, val] of formData.entries()) {
                if (data[key]) {
                    if (!Array.isArray(data[key])) data[key] = [data[key]];
                    data[key].push(val);
                } else {
                    data[key] = val;
                }
            }
            console.log('Onboarding data:', data);
            feedbackDiv.innerHTML = `✅ Form valid! Check console (F12) for details. Total CTC: ₹ ${totalCTCAnnual.value} annually.`;
            feedbackDiv.className = 'feedback success';
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