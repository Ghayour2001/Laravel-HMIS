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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->string('employee_name');
            $table->string('father_name');
            $table->string('email');
            $table->date('dob');
            $table->string('cnic');
            $table->string('contact_no');
            $table->string('position');
            $table->string('qualification');
            $table->string('probation_period');
            $table->text('address');
            $table->string('image')->nullable();
            $table->string('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
