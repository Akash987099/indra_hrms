<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    protected $table = "employees";

    protected $fillable = [
        'employee_code','first_name','last_name','email','phone',
        'department','role','store_area','shift',
        'join_date','salary','address','status', 'password'
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    public function performance()
    {
        return $this->hasOne(EmployeePerformance::class);
    }

    public function kpis()
    {
        return $this->hasMany(EmployeeKpi::class);
    }

    // ✅ optional but recommended
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'id');
    }

    // ✅ optional full name helper
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
