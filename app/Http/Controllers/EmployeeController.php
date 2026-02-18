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

class EmployeeController extends Controller
{
    public function index()
    {
        $department = Department::all();
        $designation = Designation::all();
        $employee = Employee::leftJoin('departments', 'employees.department', '=', 'departments.id')
            ->leftJoin('designations', 'employees.role', '=', 'designations.id')
            ->select(
                'employees.*',
                'departments.name as department_name',
                'designations.name as role_name'
            )
            ->orderBy('employees.id', 'desc')
            ->paginate(config('constants.pagination_limit'));

        return view('admin.employee.index', compact('employee', 'department', 'designation'));
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
}
