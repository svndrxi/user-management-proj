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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('action');      // e.g. created_user
            $table->string('module');      // e.g. User Management
            $table->text('description')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('browser')->nullable();       // user agent parsed
            $table->json('old_values')->nullable();      // what changed from
            $table->json('new_values')->nullable();      // what changed to
            $table->nullableMorphs('subject');           // the affected model (polymorphic)

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
