<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeKpi extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'quarter',
        'target',
        'weightage',
        'deadline'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
