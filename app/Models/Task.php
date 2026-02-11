<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title','assigned_to','priority','status','progress',
        'start_date','due_date','description','created_by','completed_at'
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'completed_at' => 'datetime',
    ];

    public function assignee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'assigned_to');
    }

    // ✅ computed overdue (DB me store nahi)
    public function getIsOverdueAttribute()
    {
        return $this->status !== 'Completed'
            && $this->due_date
            && $this->due_date->lt(now()->startOfDay());
    }
}
