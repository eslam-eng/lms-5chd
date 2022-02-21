<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseInstallmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_installment_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('webinar_id')->unsigned();
            $table->foreign('webinar_id')->references('id')->on('webinars')->onDelete('cascade');
            $table->integer('creator_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title',64);
            $table->integer('price')->nullable();
            $table->enum('installment_type',['day','month','year'])->nullable();
            $table->integer('installment_interval_number');
            $table->integer('installment_num')->nullable();
            $table->integer('deleted_at')->nullable();
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
        Schema::dropIfExists('course_installment_plans');
    }
}
