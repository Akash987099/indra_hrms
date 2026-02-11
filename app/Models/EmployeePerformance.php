<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePerformance extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'attendance_percent',
        'task_completion',
        'customer_rating',
        'overall_score',
        'rating'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
