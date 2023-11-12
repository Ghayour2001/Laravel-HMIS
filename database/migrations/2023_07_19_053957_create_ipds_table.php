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
        Schema::create('ipds', function (Blueprint $table) {
            $table->id();
             // Foreign keys
            $table->foreignId('user_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('bedgroup_id')->constrained();
            $table->foreignId('bed_id')->constrained();
            $table->foreignId('insurance_id')->nullable();
            $table->foreign('insurance_id')->references('id')->on('insurances');
             //
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('dob')->nullable();
            $table->string('cnic');
            $table->string('contact_no');
            $table->string('symptom')->nullable();;
            $table->string('symptom_description')->nullable();;
            $table->date('date_of_birth');
            $table->string('city');
            $table->string('guardian_name');
            $table->string('guardian_contact');
            $table->text('address');
            $table->string('reference')->nullable();;
            $table->string('password');
            $table->boolean('food')->default(false);
            $table->string('pat_gender');
            $table->string('image')->nullable();
            $table->timestamps();


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipds');
    }
};
