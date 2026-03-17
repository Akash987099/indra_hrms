<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Onboarding · detailed compensation</title>

<style>

/* ===== SAME DESIGN ===== */

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',Roboto,system-ui,sans-serif;
}

body{
background:#eef2f7;
padding:2rem 1rem;
display:flex;
justify-content:center;
}

.container{
max-width:1300px;
width:100%;
background:white;
border-radius:2rem;
box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);
padding:2rem 2rem 2.5rem;
}

h1{
font-size:2.2rem;
font-weight:600;
color:#0a2b3c;
margin-bottom:.25rem;
border-left:8px solid #2b6f9b;
padding-left:1.5rem;
}

.subhead{
color:#4a5c6b;
margin:0 0 2rem 2.2rem;
font-size:1rem;
}

fieldset{
border:1px solid #d8e2ec;
border-radius:1.5rem;
padding:1.5rem 2rem;
margin-bottom:2rem;
background:#fafcff;
}

legend{
font-size:1.3rem;
font-weight:600;
background:white;
padding:.3rem 1.2rem;
border-radius:40px;
border:1px solid #cbd5e1;
color:#1e4b6e;
}

.form-grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:1.5rem 2rem;
margin-top:1rem;
}

.form-group{
display:flex;
flex-direction:column;
gap:.4rem;
}

.full-width{
grid-column:span 2;
}

input,select,textarea{
padding:.7rem 1rem;
border:1.5px solid #e2e8f0;
border-radius:14px;
font-size:.95rem;
}

.comp-table{
width:100%;
border-collapse:collapse;
}

.comp-table th{
background:#1f4662;
color:white;
padding:.8rem;
}

.comp-table td{
padding:.7rem;
border-bottom:1px solid #e2eaf2;
}

.comp-table input{
width:140px;
padding:.5rem;
border-radius:30px;
border:1px solid #cbdae8;
}

.form-actions{
display:flex;
gap:1rem;
justify-content:center;
margin-top:2rem;
}

button{
background:#1a4b6d;
color:white;
border:none;
padding:1rem 3rem;
border-radius:60px;
cursor:pointer;
}

</style>
</head>

<body>

<div class="container">

<h1>📋 EMPLOYEE ONBOARDING</h1>
<div class="subhead">detailed compensation · auto-calculated totals</div>

@if(session('success'))
<div style="background:#d4edda;padding:10px;margin-bottom:10px">
{{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background:#f8d7da;padding:10px;margin-bottom:10px">
{{ session('error') }}
</div>
@endif


<form method="POST"
action="{{ route('employee.store_on') }}"
enctype="multipart/form-data">

@csrf


<!-- BASIC DETAILS -->

<fieldset>
<legend>1. Basic details</legend>

<div class="form-grid">

<div class="form-group">
<label>Employee ID</label>
<input type="text" name="empId">
</div>

<div class="form-group">
<label>Employee Name</label>
<input type="text" name="empName">
</div>

<div class="form-group">
<label>Father / Husband name</label>
<input type="text" name="fatherName">
</div>

<div class="form-group">
<label>Date of birth</label>
<input type="date" name="dob">
</div>

<div class="form-group">
<label>Gender</label>
<select name="gender">
<option value="">Select</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>
</div>

<div class="form-group">
<label>Mobile</label>
<input type="text" name="mobile">
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email">
</div>

<div class="form-group">
<label>Marital Status</label>
<select name="maritalStatus">
<option value="">Select</option>
<option>Single</option>
<option>Married</option>
<option>Divorced</option>
<option>Widowed</option>
</select>
</div>

<div class="form-group">
<label>Blood Group</label>
<input type="text" name="bloodGroup">
</div>

<div class="form-group full-width">
<label>Photograph</label>
<input type="file" name="photo">
</div>

</div>
</fieldset>


<!-- ADDRESS -->

<fieldset>
<legend>2. Address details</legend>

<div class="form-grid">

<div class="form-group full-width">
<label>Current Address</label>
<textarea name="currentAddress"></textarea>
</div>

<div class="form-group full-width">
<label>Permanent Address</label>
<textarea name="permanentAddress"></textarea>
</div>

<div class="form-group">
<label>City</label>
<input type="text" name="city">
</div>

<div class="form-group">
<label>State</label>
<input type="text" name="state">
</div>

<div class="form-group full-width">
<label>Pincode</label>
<input type="text" name="pinCode">
</div>

</div>
</fieldset>


<!-- JOB -->

<fieldset>
<legend>3. Job details</legend>

<div class="form-grid">

<div class="form-group">
<label>Department</label>
<input type="text" name="department">
</div>

<div class="form-group">
<label>Designation</label>
<input type="text" name="designation">
</div>

<div class="form-group">
<label>Work Location</label>
<input type="text" name="workLocation">
</div>

<div class="form-group">
<label>Date of Joining</label>
<input type="date" name="doj">
</div>

<div class="form-group">
<label>Employment Type</label>
<select name="employmentType">
<option>Full Time</option>
<option>Part Time</option>
<option>Contract</option>
</select>
</div>

<div class="form-group">
<label>Reporting Manager</label>
<input type="text" name="reportingManager">
</div>

<div class="form-group full-width">
<label>Shift Timing</label>
<input type="text" name="shiftTiming">
</div>

</div>
</fieldset>


<!-- SALARY STRUCTURE -->

<fieldset>
<legend>4. Salary Structure</legend>

<table class="comp-table">

<thead>
<tr>
<th>Component</th>
<th>Monthly</th>
<th>Annual</th>
</tr>
</thead>

<tbody>

<tr>
<td>Basic Salary</td>
<td><input type="number" id="basicMonthly" name="basicMonthly"></td>
<td><input type="number" id="basicAnnual" name="basicAnnual" readonly></td>
</tr>

<tr>
<td>HRA</td>
<td><input type="number" id="hraMonthly" name="hraMonthly"></td>
<td><input type="number" id="hraAnnual" name="hraAnnual" readonly></td>
</tr>

<tr>
<td>Flexi Pay</td>
<td><input type="number" id="flexiMonthly" name="flexiMonthly"></td>
<td><input type="number" id="flexiAnnual" name="flexiAnnual" readonly></td>
</tr>

<tr>
<td>PF</td>
<td><input type="number" id="pfMonthly" name="pfMonthly"></td>
<td><input type="number" id="pfAnnual" name="pfAnnual" readonly></td>
</tr>

<tr>
<td><b>Total CTC</b></td>
<td><input type="number" id="totalMonthly" name="totalCTCMonthly" readonly></td>
<td><input type="number" id="totalAnnual" name="totalCTCAnnual" readonly></td>
</tr>

</tbody>
</table>

</fieldset>


<!-- GOVERNMENT -->

<fieldset>
<legend>5. Government Compliance</legend>

<div class="form-grid">

<input type="text" name="aadhaar" placeholder="Aadhaar">

<input type="text" name="pan" placeholder="PAN">

<input type="text" name="pf" placeholder="PF">

<input type="text" name="esic" placeholder="ESIC">

<input type="text" name="uan" placeholder="UAN">

</div>

</fieldset>


<!-- EMERGENCY -->

<fieldset>
<legend>6. Emergency Contact</legend>

<div class="form-grid">

<input type="text" name="emergencyName" placeholder="Name">

<input type="text" name="emergencyPhone" placeholder="Phone">

<input type="text" name="emergencyRelation" placeholder="Relation">

</div>

</fieldset>


<!-- HR STATUS -->

<fieldset>
<legend>7. HR Status</legend>

<select name="empStatus">
<option value="Active">Active</option>
<option value="Left">Left</option>
</select>

</fieldset>


<div class="form-actions">

<button type="submit">Submit Onboarding</button>

<button type="reset">Reset</button>

</div>

</form>
</div>


<script>

function calculateSalary(){

let basic = Number(document.getElementById('basicMonthly').value) || 0
let hra = Number(document.getElementById('hraMonthly').value) || 0
let flexi = Number(document.getElementById('flexiMonthly').value) || 0
let pf = Number(document.getElementById('pfMonthly').value) || 0

document.getElementById('basicAnnual').value = basic*12
document.getElementById('hraAnnual').value = hra*12
document.getElementById('flexiAnnual').value = flexi*12
document.getElementById('pfAnnual').value = pf*12

let monthly = basic+hra+flexi+pf
let annual = monthly*12

document.getElementById('totalMonthly').value = monthly
document.getElementById('totalAnnual').value = annual

}

document.querySelectorAll('#basicMonthly,#hraMonthly,#flexiMonthly,#pfMonthly')
.forEach(el=>{

el.addEventListener('input',calculateSalary)

})

</script>

</body>
</html>