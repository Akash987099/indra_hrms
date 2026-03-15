<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeOnboarding extends Model
{

    protected $table = "employee_onboardings";

    protected $fillable = [

        'employee_id',

        'employee_type',

        'full_name',
        'mobile',
        'email',

        'aadhaar',
        'pan',

        'dob',
        'age',

        'joining_date',
        'contract_end_date',
        'probation_end_date',
        'probation_period_months',

        'gender',
        'blood_group',
        'marital_status',

        'address',
        'district',
        'state',
        'pincode',

        'emergency_name',
        'emergency_phone',
        'emergency_relation',

        'department',
        'designation',
        'sub_department',
        'team',
        'work_area',

        'shift',
        'reporting_manager',

        'salary_type',
        'salary_amount',

        'payment_mode',
        'payment_date_day',

        'bank_name',
        'account_number',
        'ifsc_code',
        'uan_number',

        'hrms_modules',

        'documents',

        'additional_notes'
    ];

    protected $casts = [

        'hrms_modules' => 'array',
        'documents' => 'array',

        'dob' => 'date',

        'joining_date' => 'date',

        'contract_end_date' => 'date',

        'probation_end_date' => 'date'

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

}