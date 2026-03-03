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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('designation')->nullable();
            
            // Foreign Keys - constrained() automatically finds the table name
            $table->foreignId('office_id')->nullable()->constrained('offices')->onDelete('set null');
            $table->foreignId('role_id')->nullable()->constrained('account_roles')->onDelete('set null');
            
            $table->rememberToken(); // Required for Laravel Auth
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
