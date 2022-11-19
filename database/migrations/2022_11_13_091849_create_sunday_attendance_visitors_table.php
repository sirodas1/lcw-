<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sunday_attendance_visitors', function (Blueprint $table) {
            $table->id();
            $table->date('sunday_date');
            $table->foreignId('zone_id')->constrained('zones')->cascadeOnDelete();
            $table->foreignId('report_id')->constrained('reports')->cascadeOnDelete();
            $table->foreignId('visitor_id')->constrained('visitors')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sunday_attendance_visitors');
    }
};
