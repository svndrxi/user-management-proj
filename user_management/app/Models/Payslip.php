<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payslip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // Pay Period
        'pay_period',

        // Employee Information
        'name',
        'employee_id',
        'department',
        'designation',

        // Earnings
        'monthly_salary',
        'pera',
        'gross_amount',

        // Deductions
        'gsis_premium',
        'hdmf_premium',
        'tax_withheld',
        'philhealth',
        'conso_loan',
        'policy_loan',
        'hdmf_loan',
        'landbank_loan',
        'lraea',
        'gabay',
        'lraecc',
        'ecash_adv',
        'educ_ln',
        'emer_ln',
        'fip_g',
        'fire_h',
        'fire_n',
        'hdmf_cal',
        'hdmg_hsng',
        'honor_disallow',
        'ltcp_disallow',
        'lwop',
        'mp2',
        'mri_h',
        'mri_n',
        'nhfmc',
        'opt_pol_ln',
        'rel',
        'sri_g',
        'uoli',
        'gfal_ii',
        'mpl',
        'mpl_lite',
        'comp_ln',
        'nards',
        'fine',
        'help',
        'pvb_ln',

        'total_deductions',

        // Net Pay
        'net_pay',
        'pay_15th',
        'pay_30th',
        '15th_dop',
        '30th_dop',
        'aom_2013_014',
        'cna_2009',
        'dorm_fee',

        'is_archived',
    ];

    protected $casts = [
        'pay_period' => 'date',
        '15th_dop' => 'date',
        '30th_dop' => 'date',
        'is_archived' => 'boolean',
    ];
}
