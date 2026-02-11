<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;
    protected $table = 'leave_applications';

    protected $fillable = [
        'employee_id',
        'leave_type',
        'from_date',
        'to_date',
        'duration_days',
        'reason',
        'contact_no',
        'status',
        'action_by',
        'action_at',
        'action_remark',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'action_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }
}
