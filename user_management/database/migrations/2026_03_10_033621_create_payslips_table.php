<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();

            $table->date('pay_period')->nullable();

            // Employee Information
            $table->string('employee_id')->index(); 
            $table->string('name');
            $table->string('department')->nullable();
            $table->string('designation');

            // Earnings
            $table->decimal('monthly_salary', 12, 2)->nullable();
            $table->decimal('pera', 12, 2)->nullable();
            $table->decimal('gross_amount', 12, 2)->nullable();

            // Deductions
            $table->decimal('gsis_premium', 12, 2)->nullable();
            $table->decimal('hdmf_premium', 12, 2)->nullable();
            $table->decimal('tax_withheld', 12, 2)->nullable();
            $table->decimal('philhealth', 12, 2)->nullable();
            $table->decimal('conso_loan', 12, 2)->nullable();
            $table->decimal('policy_loan', 12, 2)->nullable();
            $table->decimal('hdmf_loan', 12, 2)->nullable();
            $table->decimal('landbank_loan', 12, 2)->nullable();
            $table->decimal('lraea', 12, 2)->nullable();
            $table->decimal('gabay', 12, 2)->nullable();
            $table->decimal('lraecc', 12, 2)->nullable();
            $table->decimal('ecash_adv', 12, 2)->nullable();
            $table->decimal('educ_ln', 12, 2)->nullable();
            $table->decimal('emer_ln', 12, 2)->nullable();
            $table->decimal('fip_g', 12, 2)->nullable();
            $table->decimal('fire_h', 12, 2)->nullable();
            $table->decimal('fire_n', 12, 2)->nullable();
            $table->decimal('hdmf_cal', 12, 2)->nullable();
            $table->decimal('hdmg_hsng', 12, 2)->nullable();
            $table->decimal('honor_disallow', 12, 2)->nullable();
            $table->decimal('ltcp_disallow', 12, 2)->nullable();
            $table->decimal('lwop', 12, 2)->nullable();
            $table->decimal('mp2', 12, 2)->nullable();
            $table->decimal('mri_h', 12, 2)->nullable();
            $table->decimal('mri_n', 12, 2)->nullable();
            $table->decimal('nhfmc', 12, 2)->nullable();
            $table->decimal('opt_pol_ln', 12, 2)->nullable();
            $table->decimal('rel', 12, 2)->nullable();
            $table->decimal('sri_g', 12, 2)->nullable();
            $table->decimal('uoli', 12, 2)->nullable();
            $table->decimal('gfal_ii', 12, 2)->nullable();
            $table->decimal('mpl', 12, 2)->nullable();
            $table->decimal('mpl_lite', 12, 2)->nullable();
            $table->decimal('comp_ln', 12, 2)->nullable();
            $table->decimal('nards', 12, 2)->nullable();
            $table->decimal('fine', 12, 2)->nullable();
            $table->decimal('help', 12, 2)->nullable();
            $table->decimal('pvb_ln', 12, 2)->nullable();

            $table->decimal('total_deductions', 12, 2)->nullable();

            // Net Pay
            $table->decimal('net_pay', 12, 2)->nullable();
            $table->decimal('pay_15th', 12, 2)->nullable();
            $table->decimal('pay_30th', 12, 2)->nullable();
            $table->date('15th_dop')->nullable();
            $table->date('30th_dop')->nullable();
            $table->decimal('aom_2013_014', 12, 2)->nullable();
            $table->decimal('cna_2009', 12, 2)->nullable();
            $table->decimal('dorm_fee', 12, 2)->nullable();

            $table->boolean('is_archived')->default(false);

            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
