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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_id')->nullable()->constrained(); // Set insurance_id as nullable foreign key
            $table->foreignId('symptom_id')->nullable()->constrained(); // Set insurance_id as nullable foreign key
            $table->foreignId('user_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->string('name');
            $table->string('type');
            $table->string('age');
            $table->string('dob');
            $table->string('pat_gender');
            $table->string('cnic');
            $table->string('contact_no');
            $table->string('date_of_birth')->nullable();
            $table->string('city');
            $table->string('guardian_name');
            $table->string('guardian_contact');
            $table->string('reference')->nullable();
            $table->string('address');
            $table->string('image')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
