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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->unsignedInteger('age');
            $table->string('phone_number');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('vein_centers');
            $table->string('full_address');
            $table->enum('appointment_type', ['home', 'lab']);
            $table->date('date');
            $table->time('time');
            $table->unsignedBigInteger('slot_id'); 
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('test_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('slot_id')->references('id')->on('slots')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
