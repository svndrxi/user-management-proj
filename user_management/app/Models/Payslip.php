<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payslip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'payroll_date',
        'is_archived',
    ];

    protected $casts = [
        'payroll_date' => 'date',
        'is_archived' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
