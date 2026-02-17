<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $fillable = ['id', 'emp_code', 'file_name', 'file_path', 'created_at', 'updated_at'];
}
