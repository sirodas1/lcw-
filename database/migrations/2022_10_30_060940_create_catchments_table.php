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
        Schema::create('catchments', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->foreignId('zone_id')->cascadeOnDelete();
            $table->timestamps();
        });
        //Add catchment foreign key to members table.
        Schema::table('members', function (Blueprint $table) {
            $table->foreign('catchment_id')->references('id')->on('catchments')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catchments');
    }
};
