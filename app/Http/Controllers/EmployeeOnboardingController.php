<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeOnboarding;
use Illuminate\Validation\Rule;
use App\Models\Employee;

class EmployeeOnboardingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employeeId' => ['required'],
            'employeeType' => ['required', 'string', 'max:30'],
            'fullName'     => ['required', 'string', 'max:150'],
            'mobile'       => ['required', 'digits:10'],
            'email'        => ['required', 'email', 'max:150', Rule::unique('employee_onboardings', 'email')],
            'aadhaar'      => ['required', 'digits:12', Rule::unique('employee_onboardings', 'aadhaar')],
            'pan'          => ['required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', Rule::unique('employee_onboardings', 'pan')],
            'dob'          => ['required', 'date'],
            'age'          => ['nullable'],

            'joiningDate'  => ['required', 'date'],
            'contractEndDate' => ['nullable', 'date', 'after_or_equal:joiningDate'],
            'probationEndDate' => ['nullable', 'date', 'after_or_equal:joiningDate'],
            'probationPeriod' => ['nullable', 'integer', 'min:0', 'max:24'],

            'gender' => ['required', 'string', 'max:10'],
            'bloodGroup' => ['nullable', 'string', 'max:5'],

            'address' => ['required', 'string'],
            'district' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'pincode' => ['required', 'digits:6'],
            'maritalStatus' => ['nullable', 'string', 'max:20'],

            'emergencyName' => ['required', 'string', 'max:150'],
            'emergencyPhone' => ['required', 'digits:10'],
            'emergencyRelation' => ['nullable', 'string', 'max:100'],

            'department' => ['required', 'string', 'max:150'],
            'designation' => ['required', 'string', 'max:150'],
            'subDepartment' => ['nullable', 'string', 'max:150'],
            'team' => ['nullable', 'string', 'max:150'],
            'workArea' => ['required', 'string', 'max:100'],
            'shift' => ['required', 'string', 'max:50'],
            'reportingManager' => ['nullable', 'string', 'max:150'],

            'salaryType' => ['required', 'string', 'max:30'],
            'salaryAmount' => ['required', 'numeric', 'min:0'],

            'paymentMode' => ['nullable', 'string', 'max:30'],
            'paymentDate' => ['nullable', 'integer', 'min:1', 'max:31'],

            'bankName' => ['nullable', 'string', 'max:150'],
            'accountNumber' => ['nullable', 'string', 'max:30'],
            'ifscCode' => ['nullable', 'string', 'max:20'],
            'uanNumber' => ['nullable', 'string', 'max:30'],

            'hrmsModules' => ['nullable', 'array'],
            'documents' => ['nullable', 'array'],
            'additionalNotes' => ['nullable', 'string'],
        ]);

        // $employeeId = "MALL-" . substr((string) now()->timestamp . rand(100, 999), -6);
        
        // dd($request->employeeId);exit();
        
        $employee = Employee::where('id',$request->employeeId)->first();

        $saved = EmployeeOnboarding::create([
            'employee_type' => $validated['employeeType'],
            'employee_id' => $request->employeeId,
            'full_name' => $validated['fullName'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'],
            'aadhaar' => $validated['aadhaar'],
            'pan' => $validated['pan'],
            'dob' => $validated['dob'],
            'age' => $validated['age'] ?? null,

            'joining_date' => $validated['joiningDate'],
            'contract_end_date' => $validated['contractEndDate'] ?? null,
            'probation_end_date' => $validated['probationEndDate'] ?? null,
            'probation_period_months' => (int)($validated['probationPeriod'] ?? 0),

            'gender' => $validated['gender'],
            'blood_group' => $validated['bloodGroup'] ?? null,

            'address' => $validated['address'],
            'district' => $validated['district'],
            'state' => $validated['state'],
            'pincode' => $validated['pincode'],
            'marital_status' => $validated['maritalStatus'] ?? null,

            'emergency_name' => $validated['emergencyName'],
            'emergency_phone' => $validated['emergencyPhone'],
            'emergency_relation' => $validated['emergencyRelation'] ?? null,

            'department' => $validated['department'],
            'designation' => $validated['designation'],
            'sub_department' => $validated['subDepartment'] ?? null,
            'team' => $validated['team'] ?? null,
            'work_area' => $validated['workArea'],
            'shift' => $validated['shift'],
            'reporting_manager' => $validated['reportingManager'] ?? null,

            'salary_type' => $validated['salaryType'],
            'salary_amount' => $validated['salaryAmount'],

            'payment_mode' => $validated['paymentMode'] ?? 'Bank Transfer',
            'payment_date_day' => $validated['paymentDate'] ?? null,

            'bank_name' => $validated['bankName'] ?? null,
            'account_number' => $validated['accountNumber'] ?? null,
            'ifsc_code' => $validated['ifscCode'] ?? null,
            'uan_number' => $validated['uanNumber'] ?? null,

            'hrms_modules' => $validated['hrmsModules'] ?? [],
            'documents' => $validated['documents'] ?? [],
            'additional_notes' => $validated['additionalNotes'] ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Employee onboarding saved successfully',
            'employee_id' => $employee->employee_code,
            'data' => [
                'fullName' => $saved->full_name,
                'department' => $saved->department,
                'designation' => $saved->designation,
                'joiningDate' => $saved->joining_date->format('Y-m-d'),
                'email' => $saved->email,
            ]
        ]);
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'employeeId' => ['required'],
            'employeeType' => ['required', 'string', 'max:30'],
            'fullName'     => ['required', 'string', 'max:150'],
            'mobile'       => ['required', 'digits:10'],
            'email'        => ['required', 'email'],
            'aadhaar'      => ['required', 'digits:12'],
            'pan'          => ['required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'],
            'dob'          => ['required', 'date'],
            'age'          => ['nullable'],

            'joiningDate'  => ['required', 'date'],
            'contractEndDate' => ['nullable', 'date', 'after_or_equal:joiningDate'],
            'probationEndDate' => ['nullable', 'date', 'after_or_equal:joiningDate'],
            'probationPeriod' => ['nullable', 'integer', 'min:0', 'max:24'],

            'gender' => ['required', 'string', 'max:10'],
            'bloodGroup' => ['nullable', 'string', 'max:5'],

            'address' => ['required', 'string'],
            'district' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'pincode' => ['required', 'digits:6'],
            'maritalStatus' => ['nullable', 'string', 'max:20'],

            'emergencyName' => ['required', 'string', 'max:150'],
            'emergencyPhone' => ['required', 'digits:10'],
            'emergencyRelation' => ['nullable', 'string', 'max:100'],

            'department' => ['required', 'string', 'max:150'],
            'designation' => ['required', 'string', 'max:150'],
            'subDepartment' => ['nullable', 'string', 'max:150'],
            'team' => ['nullable', 'string', 'max:150'],
            'workArea' => ['required', 'string', 'max:100'],
            'shift' => ['required', 'string', 'max:50'],
            'reportingManager' => ['nullable', 'string', 'max:150'],

            'salaryType' => ['required', 'string', 'max:30'],
            'salaryAmount' => ['required', 'numeric', 'min:0'],

            'paymentMode' => ['nullable', 'string', 'max:30'],
            'paymentDate' => ['nullable', 'integer', 'min:1', 'max:31'],

            'bankName' => ['nullable', 'string', 'max:150'],
            'accountNumber' => ['nullable', 'string', 'max:30'],
            'ifscCode' => ['nullable', 'string', 'max:20'],
            'uanNumber' => ['nullable', 'string', 'max:30'],

            'hrmsModules' => ['nullable', 'array'],
            'documents' => ['nullable', 'array'],
            'additionalNotes' => ['nullable', 'string'],
        ]);

        $employeeId = "MALL-" . substr((string) now()->timestamp . rand(100, 999), -6);

        $saved = EmployeeOnboarding::where('id', $validated['employeeId'])->update([
            'employee_type' => $validated['employeeType'],
            'full_name' => $validated['fullName'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'],
            'aadhaar' => $validated['aadhaar'],
            'pan' => $validated['pan'],
            'dob' => $validated['dob'],
            'age' => $validated['age'] ?? null,

            'joining_date' => $validated['joiningDate'],
            'contract_end_date' => $validated['contractEndDate'] ?? null,
            'probation_end_date' => $validated['probationEndDate'] ?? null,
            'probation_period_months' => (int)($validated['probationPeriod'] ?? 0),

            'gender' => $validated['gender'],
            'blood_group' => $validated['bloodGroup'] ?? null,

            'address' => $validated['address'],
            'district' => $validated['district'],
            'state' => $validated['state'],
            'pincode' => $validated['pincode'],
            'marital_status' => $validated['maritalStatus'] ?? null,

            'emergency_name' => $validated['emergencyName'],
            'emergency_phone' => $validated['emergencyPhone'],
            'emergency_relation' => $validated['emergencyRelation'] ?? null,

            'department' => $validated['department'],
            'designation' => $validated['designation'],
            'sub_department' => $validated['subDepartment'] ?? null,
            'team' => $validated['team'] ?? null,
            'work_area' => $validated['workArea'],
            'shift' => $validated['shift'],
            'reporting_manager' => $validated['reportingManager'] ?? null,

            'salary_type' => $validated['salaryType'],
            'salary_amount' => $validated['salaryAmount'],

            'payment_mode' => $validated['paymentMode'] ?? 'Bank Transfer',
            'payment_date_day' => $validated['paymentDate'] ?? null,

            'bank_name' => $validated['bankName'] ?? null,
            'account_number' => $validated['accountNumber'] ?? null,
            'ifsc_code' => $validated['ifscCode'] ?? null,
            'uan_number' => $validated['uanNumber'] ?? null,

            'hrms_modules' => $validated['hrmsModules'] ?? [],
            'documents' => $validated['documents'] ?? [],
            'additional_notes' => $validated['additionalNotes'] ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Employee onboarding saved successfully',
            // 'employee_id' => $employeeId,
            'data' => [
                'fullName' => $saved->full_name,
                'department' => $saved->department,
                'designation' => $saved->designation,
                'joiningDate' => $saved->joining_date->format('Y-m-d'),
                'email' => $saved->email,
            ]
        ]);
    }
}