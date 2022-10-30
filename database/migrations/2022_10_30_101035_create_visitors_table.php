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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('othername')->nullable();
            $table->enum('title',['Dr.', 'Mr.', 'Mrs.', 'Miss']);
            $table->enum('gender', ['Male', 'Female']);
            $table->date('dob');
            $table->enum('marital_status', ['Single', 'Married', 'Divorced'])->default('Single');
            $table->string('previous_church_bg')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('occupation');
            $table->string('location');
            $table->string('invited_by')->nullable();
            $table->enum('any_relations', ['Parent', 'Sibling', 'Friend'])->nullable();
            $table->boolean('baptized')->default(false);
            $table->boolean('foundation_sch_status')->default(false);
            $table->boolean('sld_subscription')->default(false);
            $table->foreignId('catchment_id')->nullable()->nullOnDelete();
            $table->integer('attendance')->default(1);
            $table->mediumText('attendance_days')->nullable();
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
        Schema::dropIfExists('visitors');
    }
};
