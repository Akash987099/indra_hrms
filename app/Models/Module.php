<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $table = 'modules';
    protected $fillable = ['id', 'name', 'view', 'edit', 'delete', 'update', 'department_permissions', 'created_at', 'updated_at'];
}
