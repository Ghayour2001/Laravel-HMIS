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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(0); // Add the "is_active" column with a default value of 0
            $table->string('order_by')->nullable(); // Add the "order_by" column
            $table->boolean('is_open_for_admission')->default(0); // Add the "is_open_for_admission" column with a default value of 0
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
