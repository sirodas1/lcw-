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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leader_id')->constrained('users')->cascadeOnDelete();
            $table->date('sunday_date');
            $table->time('arrival_time');
            $table->integer('number_of_new_souls')->default(0);
            $table->string('means_of_transport');
            $table->integer('number_of_vehicles_brought')->default(1);
            $table->string('recommendations')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('reports');
    }
};
