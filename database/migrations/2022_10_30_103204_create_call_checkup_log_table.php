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
        Schema::create('call_checkup_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->nullOnDelete();
            $table->foreignId('member_id')->cascadeOnDelete();
            $table->boolean('status')->default(false);
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('call_checkup_log');
    }
};
