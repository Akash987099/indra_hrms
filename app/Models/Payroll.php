<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'payroll_month',
        'department',
        'basic_salary',
        'allowances',
        'deductions',
        'bonus_percentage',
        'bonus_amount',
        'net_salary',
        'status',
        'processed_at',
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }
}
