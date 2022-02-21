<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('date_collection')->nullable();
            $table->integer('collection_value')->nullable();
            $table->unsignedBigInteger('parent_installment_id');
            $table->foreign('parent_installment_id')->references('id')->on('installments')->onDelete('cascade');
            $table->string('note')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('installment_details');
    }
}
