<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Folder;
use App\Models\EmployeeOnboarding;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Document;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $department = Department::all();
        $designation = Designation::all();

        $query = Employee::leftJoin('departments', 'employees.department', '=', 'departments.id')
            ->leftJoin('designations', 'employees.role', '=', 'designations.id')
            ->select(
                'employees.*',
                'departments.name as department_name',
                'designations.name as role_name'
            );

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('employees.first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('employees.last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('employees.employee_code', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->department) {
            $query->where('employees.department', $request->department);
        }

        if ($request->status) {
            $query->where('employees.status', $request->status);
        }

        if ($request->sort == 'name') {
            $query->orderBy('employees.first_name', 'asc');
        } elseif ($request->sort == 'name-desc') {
            $query->orderBy('employees.first_name', 'desc');
        } elseif ($request->sort == 'date') {
            $query->orderBy('employees.join_date', 'desc');
        } elseif ($request->sort == 'date-old') {
            $query->orderBy('employees.join_date', 'asc');
        } else {
            $query->orderBy('employees.id', 'desc');
        }

        $employee = $query->paginate(config('constants.pagination_limit'))->appends($request->all());

        return view('admin.employee.index', compact('employee', 'department', 'designation'));
    }

    public function exportEmployees()
    {
        return Excel::download(new EmployeeExport, 'employees.xlsx');
    }

    public function transfer($id)
    {
        if (!$id) {
            return redirect()->back()->with('message', 'ID not found!');
        }

        $employeedata = EmployeeOnboarding::find($id);

        if (!$employeedata) {
            return redirect()->back()->with('message', 'Record not found!');
        }

        DB::beginTransaction();

        try {
            // ✅ Create employee
            $employee = Employee::create([
                'employee_code' => $employeedata->employee_id
                    ?? 'EMP-' . rand(100000, 999999),

                'first_name' => $employeedata->full_name,
                'last_name'  => '',

                'email' => $employeedata->email,
                'phone' => $employeedata->mobile,

                'department' => $employeedata->department,
                'role'       => $employeedata->designation,
                'store_area' => $employeedata->work_area,
                'shift'      => $employeedata->shift,

                'join_date' => $employeedata->joining_date,

                'salary'        => $employeedata->salary_amount,
                'basic_salary' => $employeedata->salary_amount,

                'address' => $employeedata->address,
                'status'  => 'Active',
            ]);

            // ✅ Insert ID
            $insertId = $employee->id;

            // ✅ Update onboarding record (store transferred employee id)
            $employeedata->update([
                'employee_id' => $insertId
            ]);

            // ✅ Optional: agar onboarding record delete karna ho
            // $employeedata->delete();

            DB::commit();

            return redirect()
                ->route('employee')
                ->with('success', 'Employee transferred successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Transfer failed: ' . $e->getMessage());
        }
    }

    public function view($id)
    {
        if (!$id) {
            return redirect()->back()->with('message', 'ID not found!');
        }

        $employee = Employee::where('employee_code', $id)->first();


        if (!$employee) {
            return redirect()->back()->with('message', 'Record not found!');
        }

        $employeedata = EmployeeOnboarding::where('employee_id', $employee->id)->first();

        return view('welcome', compact('employeedata', 'employee', 'id'));
        // return view('admin.employee.view', compact('employeedata', 'employee'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName'  => 'required|string|max:100',
            'employeeid'  => 'required|string|max:100',
            'lastName'   => 'required|string|max:100',
            'email'      => 'required|email|max:150|unique:employees,email',
            'phone'      => 'required|string|max:20',
            'department' => 'required|string|max:100',
            'role'       => 'required|string|max:120',
            // 'store'      => 'required|string|max:150',
            'shift'      => 'nullable|string|max:30',
            'joinDate'   => 'required|date',
            'salary'     => 'nullable|numeric|min:0',
            'address'    => 'nullable|string',
            'status'     => 'required|string|max:20',
        ]);

        $employee = Employee::create([
            'employee_code' => $validated['employeeid'] ?? 'EMP-' . rand(100000, 999999),
            'first_name' => $validated['firstName'],
            'last_name'  => $validated['lastName'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
            'department' => $validated['department'],
            'role'       => $validated['role'],
            'store_area' => '0',
            'shift'      => $validated['shift'] ?? null,
            'join_date'  => $validated['joinDate'],
            'salary'     => $validated['salary'] ?? null,
            'address'    => $validated['address'] ?? null,
            'status'     => $validated['status'],
            'password'   => Hash::make($validated['phone']),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Employee saved successfully',
            'employee' => [
                'id' => $employee->id,
                'employee_code' => $employee->employee_code,
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'department' => $employee->department,
                'store_area' => $employee->store_area,
                'role' => $employee->role,
                'status' => $employee->status,
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'firstName'  => 'required|string|max:100',
            'lastName'   => 'required|string|max:100',
            'email'      => [
                'required',
                'email',
                'max:150',
                Rule::unique('employees', 'email')->ignore($employee->id)
            ],
            'phone'      => 'required|string|max:20',
            'department' => 'required|string|max:100',
            'role'       => 'required|string|max:120',
            // 'store'      => 'required|string|max:150',
            'shift'      => 'nullable|string|max:30',
            'joinDate'   => 'required|date',
            'salary'     => 'nullable|numeric|min:0',
            'address'    => 'nullable|string',
            'status'     => 'required|string|max:20',
        ]);

        $employee->update([
            'employee_code' => $validated['employeeid'] ?? 'EMP-' . rand(100000, 999999),
            'first_name' => $validated['firstName'],
            'last_name'  => $validated['lastName'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
            'department' => $validated['department'],
            'role'       => $validated['role'],
            // 'store_area' => $validated['store'],
            'shift'      => $validated['shift'] ?? null,
            'join_date'  => $validated['joinDate'],
            'salary'     => $validated['salary'] ?? null,
            'address'    => $validated['address'] ?? null,
            'status'     => $validated['status'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Employee updated successfully',
            'employee' => $employee,
        ]);
    }

    public function delete($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'exceptionError', 'error' => $e->getMessage()]);
        }
    }

    public function onboarding()
    {
        $employee = EmployeeOnboarding::orderBy('id', 'desc')->paginate(config('constants.pagination_limit'));
        return view('admin.employee.ragister-data', compact('employee'));
    }

    public function approval(Request $request)
    {
        // dd($request->all());

        $employee = Employee::find($request->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'No record found');
        }

        // approve status update
        $employee->is_approved = $request->status;
        $employee->save();

        // agar approve hua hai
        if ($request->status == 1) {

            // check user already exists
            $userExists = User::where('email', $employee->email)->first();

            if (!$userExists) {
                User::create([
                    'name'     => $employee->name ?? 'Employee',
                    'email'    => $employee->email,
                    'password' => Hash::make('123456'), // temp password
                ]);
            }
        }

        return redirect()->back()->with('success', 'Employee approved successfully');
    }

    public function updateStatus(Request $request)
    {
        $employee = Employee::find($request->id);

        if (!$employee) {
            return back()->with('error', 'Record not found');
        }

        $employee->status = $request->status;
        $employee->save();

        return back()->with('success', 'Status updated');
    }

    public function file($id)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'ID not found!');
        }

        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found!');
        }

        $foldername = $employee->employee_code;

        $path = public_path('documents/' . $foldername);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $data = Document::where('emp_code', $foldername)->get();

        return view('admin.employee.file_manager', compact('employee', 'data', 'foldername'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'emp_code' => 'required'
        ]);

        $folder = public_path('documents/' . $request->emp_code);

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0777, true, true);
        }

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move($folder, $filename);

        Document::create([
            'emp_code' => $request->emp_code,
            'file_name' => $filename,
            'file_path' => 'documents/' . $request->emp_code . '/' . $filename
        ]);

        return back()->with('success', 'File uploaded successfully!');
    }

    public function add()
    {
        return view('onboarding-add');
    }

    public function store_on(Request $request)
    {
        DB::beginTransaction();

        try {

            // check if form empty
            if (count(array_filter($request->except(['_token']))) == 0 && !$request->hasFile('photo')) {
                return back()->with('error', 'Form empty hai, koi data store nahi hua.');
            }

            $employeeData = array_filter([
                'employee_code' => $request->empId,
                'first_name'    => $request->empName,
                'email'         => $request->email,
                'phone'         => $request->mobile,
                'department'    => $request->department,
                'role'          => $request->designation,
                'join_date'     => $request->doj,
                'salary'        => $request->totalCTCAnnual,
                'status'        => $request->empStatus ?? 'Active',
                'password'      => Hash::make('123456')
            ]);

            $employee = Employee::create($employeeData);

            $photo = null;

            if ($request->hasFile('photo')) {
                if (!File::exists(public_path('employees'))) {
                    File::makeDirectory(public_path('employees'), 0777, true, true);
                }

                $file = $request->file('photo');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('employees'), $name);

                $photo = $name;
            }

            $documents = [];
            if ($photo) {
                $documents['photo'] = $photo;
            }

            // Create documents folder if doesn't exist
            $docsPath = public_path('employees/documents');
            if (!File::exists($docsPath)) {
                File::makeDirectory($docsPath, 0777, true, true);
            }

            if ($request->hasFile('bankDoc')) {
                $file = $request->file('bankDoc');
                $name = time() . '_bank_' . $file->getClientOriginalName();
                $file->move($docsPath, $name);
                $documents['bank_doc'] = $name;
            }

            if ($request->hasFile('expLetter')) {
                $file = $request->file('expLetter');
                $name = time() . '_exp_' . $file->getClientOriginalName();
                $file->move($docsPath, $name);
                $documents['exp_letter'] = $name;
            }

            if ($request->hasFile('eduDocs')) {
                $eduDocs = [];
                foreach ($request->file('eduDocs') as $file) {
                    $name = time() . '_edu_' . $file->getClientOriginalName();
                    $file->move($docsPath, $name);
                    $eduDocs[] = $name;
                }
                $documents['edu_docs'] = $eduDocs;
            }

            $onboardingData = [
                'employee_id'       => $employee->id,
                'employee_type'     => $request->employmentType ?? 'Full Time',

                'full_name'         => $request->empName,
                'mobile'            => $request->mobile,
                'email'             => $request->email,

                'aadhaar'           => $request->aadhaar,
                'pan'               => $request->pan,

                'dob'               => $request->dob,
                'joining_date'      => $request->doj,

                'gender'            => $request->gender,
                'blood_group'       => $request->bloodGroup,
                'marital_status'    => $request->maritalStatus,

                'address'           => $request->currentAddress,
                'district'          => $request->city,
                'state'             => $request->state,
                'pincode'           => $request->pinCode,

                'emergency_name'    => $request->emergencyName,
                'emergency_phone'   => $request->emergencyPhone,
                'emergency_relation' => $request->emergencyRelation,

                'department'        => $request->department,
                'designation'       => $request->designation,
                'work_area'         => $request->workLocation,
                'shift'             => $request->shiftTiming,
                'reporting_manager' => $request->reportingManager,

                'bank_name'         => $request->bankName,
                'account_number'    => $request->accountNo,
                'ifsc_code'         => $request->ifsc,
                'uan_number'        => $request->uan,
                'salary_amount'     => $request->totalCTCAnnual,
                'salary_type'       => 'Annual CTC',

                'additional_notes'  => json_encode([
                    'father_name' => $request->fatherName,
                    'permanent_address' => $request->permanentAddress,
                    'upi_id' => $request->upi,
                    'compliance' => [
                        'pf_number' => $request->pf,
                        'esic_number' => $request->esic,
                    ],
                    'compensation' => [
                        'basic_monthly' => $request->basicMonthly,
                        'basic_annual' => $request->basicAnnual,
                        'hra_monthly' => $request->hraMonthly,
                        'hra_annual' => $request->hraAnnual,
                        'flexi_monthly' => $request->flexiMonthly,
                        'flexi_annual' => $request->flexiAnnual,
                        'acting_monthly' => $request->actingMonthly,
                        'acting_annual' => $request->actingAnnual,
                        'sub_a_monthly' => $request->subAMonthly,
                        'sub_a_annual'  => $request->subAAnnual,
                        'pf_monthly' => $request->pfMonthly,
                        'pf_annual' => $request->pfAnnual,
                        'esi_monthly' => $request->esiMonthly,
                        'esi_annual' => $request->esiAnnual,
                        'sub_b_monthly' => $request->subBMonthly,
                        'sub_b_annual'  => $request->subBAnnual,
                        'fixed_ctc_monthly' => $request->fixedCTCMonthly,
                        'fixed_ctc_annual'  => $request->fixedCTCAnnual,
                        'pli_monthly' => $request->pliMonthly,
                        'pli_annual' => $request->pliAnnual,
                        'sub_c_monthly' => $request->subCMonthly,
                        'sub_c_annual'  => $request->subCAnnual,
                        'total_ctc_monthly' => $request->totalCTCMonthly,
                        'total_ctc_annual' => $request->totalCTCAnnual,
                    ],
                    'hr_details' => [
                        'offer_issued' => $request->offerIssued,
                        'appointment_issued' => $request->appointmentIssued,
                        'id_card_issued' => $request->idCardIssued,
                        'uniform_issued' => $request->uniformIssued,
                    ],
                    'documents_submitted' => [
                        'aadhaar_submitted' => $request->aadhaarSubmitted,
                        'pan_submitted' => $request->panSubmitted,
                    ]
                ]),
            ];

            if (!empty($documents)) {
                $onboardingData['documents'] = json_encode($documents);
            }

            EmployeeOnboarding::create($onboardingData);

            DB::commit();

            return redirect()->back()->with('success', 'Employee Onboarding Saved Successfully');
        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $onboarding = EmployeeOnboarding::where('employee_id', $employee->id)->first();
        $employeedata = $this->mapOnboardingForEdit($employee, $onboarding);

        return view('onboarding-edit', compact('employee', 'employeedata'));
    }

    private function mapOnboardingForEdit(Employee $employee, ?EmployeeOnboarding $onboarding): object
    {
        $notes = [];

        if ($onboarding?->additional_notes) {
            $notes = is_array($onboarding->additional_notes)
                ? $onboarding->additional_notes
                : (json_decode($onboarding->additional_notes, true) ?: []);
        }

        $compensation = $notes['compensation'] ?? [];
        $compliance = $notes['compliance'] ?? [];
        $hrDetails = $notes['hr_details'] ?? [];
        $documentsSubmitted = $notes['documents_submitted'] ?? [];

        return (object) [
            'empId' => $employee->employee_code ?? '',
            'empName' => $onboarding?->full_name ?? $employee->first_name ?? '',
            'fatherName' => $notes['father_name'] ?? '',
            'dob' => optional($onboarding?->dob)->format('Y-m-d'),
            'gender' => $onboarding?->gender ?? '',
            'mobile' => $onboarding?->mobile ?? $employee->phone ?? '',
            'email' => $onboarding?->email ?? $employee->email ?? '',
            'maritalStatus' => $onboarding?->marital_status ?? '',
            'bloodGroup' => $onboarding?->blood_group ?? '',

            'currentAddress' => $onboarding?->address ?? '',
            'permanentAddress' => $notes['permanent_address'] ?? '',
            'city' => $onboarding?->district ?? '',
            'state' => $onboarding?->state ?? '',
            'pinCode' => $onboarding?->pincode ?? '',

            'department' => $onboarding?->department ?? $employee->department ?? '',
            'designation' => $onboarding?->designation ?? $employee->role ?? '',
            'workLocation' => $onboarding?->work_area ?? '',
            'doj' => optional($onboarding?->joining_date)->format('Y-m-d'),
            'employmentType' => $onboarding?->employee_type ?? 'Full Time',
            'reportingManager' => $onboarding?->reporting_manager ?? '',
            'shiftTiming' => $onboarding?->shift ?? '',

            'bankName' => $onboarding?->bank_name ?? '',
            'accountNo' => $onboarding?->account_number ?? '',
            'ifsc' => $onboarding?->ifsc_code ?? '',
            'upi' => $notes['upi_id'] ?? '',

            'basicMonthly' => $compensation['basic_monthly'] ?? '0.00',
            'basicAnnual' => $compensation['basic_annual'] ?? '0.00',
            'hraMonthly' => $compensation['hra_monthly'] ?? '0.00',
            'hraAnnual' => $compensation['hra_annual'] ?? '0.00',
            'flexiMonthly' => $compensation['flexi_monthly'] ?? '0.00',
            'flexiAnnual' => $compensation['flexi_annual'] ?? '0.00',
            'actingMonthly' => $compensation['acting_monthly'] ?? '0.00',
            'actingAnnual' => $compensation['acting_annual'] ?? '0.00',
            'subAMonthly' => $compensation['sub_a_monthly'] ?? '0.00',
            'subAAnnual' => $compensation['sub_a_annual'] ?? '0.00',
            'pfMonthly' => $compensation['pf_monthly'] ?? '0.00',
            'pfAnnual' => $compensation['pf_annual'] ?? '0.00',
            'esiMonthly' => $compensation['esi_monthly'] ?? '0.00',
            'esiAnnual' => $compensation['esi_annual'] ?? '0.00',
            'subBMonthly' => $compensation['sub_b_monthly'] ?? '0.00',
            'subBAnnual' => $compensation['sub_b_annual'] ?? '0.00',
            'fixedCTCMonthly' => $compensation['fixed_ctc_monthly'] ?? '0.00',
            'fixedCTCAnnual' => $compensation['fixed_ctc_annual'] ?? ($onboarding?->salary_amount ?? '0.00'),
            'pliMonthly' => $compensation['pli_monthly'] ?? '0.00',
            'pliAnnual' => $compensation['pli_annual'] ?? '0.00',
            'subCMonthly' => $compensation['sub_c_monthly'] ?? '0.00',
            'subCAnnual' => $compensation['sub_c_annual'] ?? '0.00',
            'totalCTCMonthly' => $compensation['total_ctc_monthly'] ?? '0.00',
            'totalCTCAnnual' => $compensation['total_ctc_annual'] ?? ($onboarding?->salary_amount ?? '0.00'),

            'aadhaar' => $onboarding?->aadhaar ?? '',
            'pan' => $onboarding?->pan ?? '',
            'pf' => $compliance['pf_number'] ?? '',
            'esic' => $compliance['esic_number'] ?? '',
            'uan' => $onboarding?->uan_number ?? '',

            'aadhaarSubmitted' => $documentsSubmitted['aadhaar_submitted'] ?? 'No',
            'panSubmitted' => $documentsSubmitted['pan_submitted'] ?? 'No',

            'emergencyName' => $onboarding?->emergency_name ?? '',
            'emergencyPhone' => $onboarding?->emergency_phone ?? '',
            'emergencyRelation' => $onboarding?->emergency_relation ?? '',

            'offerIssued' => $hrDetails['offer_issued'] ?? 'No',
            'appointmentIssued' => $hrDetails['appointment_issued'] ?? 'No',
            'idCardIssued' => $hrDetails['id_card_issued'] ?? 'No',
            'uniformIssued' => $hrDetails['uniform_issued'] ?? 'No',
            'empStatus' => $employee->status ?? 'Active',
        ];
    }

}
