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
    Schema::create('insurances', function (Blueprint $table) {
        $table->id();
        $table->string('organization_name');
        $table->string('contact_no');
        $table->string('email');
        $table->integer('limit');
        $table->date('from_date');
        $table->date('to_date');
        $table->string('contact_person_name')->nullable();
        $table->string('contact_person_phone')->nullable();
        $table->string('position');
        $table->text('address')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
