<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_logs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('device_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('employee_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->string('device_user_id');

            $table->date('attendance_date');

            $table->time('attendance_time');

            $table->enum('type',[
                'check_in',
                'check_out'
            ])->default('check_in');

            $table->string('verify_type')
                  ->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};