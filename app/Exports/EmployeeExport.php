<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection
{
    public function collection()
    {
        return Employee::leftJoin('departments', 'employees.department', '=', 'departments.id')
        ->leftJoin('designations', 'employees.role', '=', 'designations.id')
        ->select(
            'employees.id',
            'employees.employee_code',
            'employees.first_name',
            'employees.last_name',
            'employees.email',
            'employees.phone',
            'departments.name as department',
            'designations.name as designation',
            'employees.store_area',
            'employees.shift',
            'employees.join_date',
            'employees.salary',
            'employees.address',
            'employees.status',
            'employees.created_at'
        )->get();
    }
}