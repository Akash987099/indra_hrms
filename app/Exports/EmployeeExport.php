<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{

    public function collection()
    {

        return Employee::leftJoin('employee_onboardings','employees.id','=','employee_onboardings.employee_id')

        ->leftJoin('departments','employees.department','=','departments.id')

        ->leftJoin('designations','employees.role','=','designations.id')

        ->select(

        // employee table

        'employees.id',
        'employees.employee_code',
        'employees.first_name',
        'employees.last_name',
        'employees.email',
        'employees.phone',
        'employees.store_area',
        'employees.shift',
        'employees.join_date',
        'employees.salary',
        'employees.address',
        'employees.status',

        // department & designation

        'departments.name as department',
        'designations.name as designation',

        // onboarding table

        'employee_onboardings.employee_type',
        'employee_onboardings.full_name',
        'employee_onboardings.mobile',
        'employee_onboardings.email as onboarding_email',

        'employee_onboardings.aadhaar',
        'employee_onboardings.pan',

        'employee_onboardings.dob',
        'employee_onboardings.age',

        'employee_onboardings.joining_date',
        'employee_onboardings.contract_end_date',
        'employee_onboardings.probation_end_date',

        'employee_onboardings.gender',
        'employee_onboardings.blood_group',
        'employee_onboardings.marital_status',

        'employee_onboardings.address as onboarding_address',
        'employee_onboardings.district',
        'employee_onboardings.state',
        'employee_onboardings.pincode',

        'employee_onboardings.emergency_name',
        'employee_onboardings.emergency_phone',
        'employee_onboardings.emergency_relation',

        'employee_onboardings.sub_department',
        'employee_onboardings.team',
        'employee_onboardings.work_area',
        'employee_onboardings.reporting_manager',

        'employee_onboardings.salary_type',
        'employee_onboardings.salary_amount',

        'employee_onboardings.payment_mode',
        'employee_onboardings.payment_date_day',

        'employee_onboardings.bank_name',
        'employee_onboardings.account_number',
        'employee_onboardings.ifsc_code',
        'employee_onboardings.uan_number',

        'employee_onboardings.additional_notes',

        'employees.created_at'

        )->get();

    }



    public function headings(): array
    {

        return [

        'ID',
        'Employee Code',
        'First Name',
        'Last Name',
        'Email',
        'Phone',
        'Store Area',
        'Shift',
        'Join Date',
        'Salary',
        'Address',
        'Status',

        'Department',
        'Designation',

        'Employee Type',
        'Full Name',
        'Mobile',
        'Onboarding Email',

        'Aadhaar',
        'PAN',

        'DOB',
        'Age',

        'Joining Date',
        'Contract End Date',
        'Probation End Date',

        'Gender',
        'Blood Group',
        'Marital Status',

        'Onboarding Address',
        'District',
        'State',
        'Pincode',

        'Emergency Name',
        'Emergency Phone',
        'Emergency Relation',

        'Sub Department',
        'Team',
        'Work Area',
        'Reporting Manager',

        'Salary Type',
        'Salary Amount',

        'Payment Mode',
        'Payment Date Day',

        'Bank Name',
        'Account Number',
        'IFSC Code',
        'UAN Number',

        'Notes',

        'Created Date'

        ];

    }

}