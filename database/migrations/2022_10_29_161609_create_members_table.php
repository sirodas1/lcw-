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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catchment_id')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('othername')->nullable();
            $table->enum('title',['Pastor', 'Deacon', 'Deaconess', 'E-Pastor', 'Steward', 'Dr.', 'Mr.', 'Mrs.', 'Miss']);
            $table->string('position')->nullable();
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
            $table->timestamps();
        });
        //Set the Foriegn Key for the Users table.
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
