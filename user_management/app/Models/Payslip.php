<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payslip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'payroll_date',
        'is_archived',
    ];

    protected $casts = [
        'payroll_date' => 'date',
        'is_archived' => 'boolean',
    ];
}
