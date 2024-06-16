<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->string('start_time');
            $table->string('end_time');
            $table->enum('type', ['home', 'lab']);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Populate slots for home collection (6 am to 9 pm)
        $this->createHomeSlots();
        
        // Populate slots for lab (24 hours)
        $this->createLabSlots();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slots');
    }

    /**
     * Create slots for home collection (6 am to 9 pm).
     *
     * @return void
     */
    private function createHomeSlots()
    {
        // Start time for home collection
        $startTime = new DateTime('06:00');
        
        // End time for home collection
        $endTime = new DateTime('21:00');
        
        // Create slots from 6 am to 9 pm at hourly intervals
        while ($startTime < $endTime) {
            DB::table('slots')->insert([
                'start_time' => $startTime->format('h:i A'),
                'end_time' => $startTime->modify('+1 hour')->format('h:i A'),
                'type' => 'home',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Create slots for lab (24 hours).
     *
     * @return void
     */
    private function createLabSlots()
    {
        // Start time for lab slots
        $startTime = new DateTime('00:00');
        
        // End time for lab slots
        $endTime = new DateTime('23:00');
        
        // Create slots for lab for 24 hours
        while ($startTime <= $endTime) {
            DB::table('slots')->insert([
                'start_time' => $startTime->format('h:i A'),
                'end_time' => $startTime->modify('+1 hour')->format('h:i A'),
                'type' => 'lab',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};
