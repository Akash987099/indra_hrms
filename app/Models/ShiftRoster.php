<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftRoster extends Model
{
    // use HasFactory;
    protected $fillable = [
        'week','department','employee_id','shift_id','shift_date',
        'status','created_by','published_by','published_at'
    ];

    protected $casts = [
        'shift_date' => 'date',
        'published_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

    public function shift()
    {
        return $this->belongsTo(\App\Models\Shift::class, 'shift_id');
    }
}
