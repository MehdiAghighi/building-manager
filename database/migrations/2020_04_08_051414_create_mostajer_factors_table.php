<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMostajerFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mostajer_factors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('factor_id')->nullable();
            $table->foreign('factor_id')->references('id')->on('factors')->onDelete('cascade');
            $table->unsignedBigInteger('mostajer_id')->nullable();
            $table->foreign('mostajer_id')->references('id')->on('mostajers')->onDelete('cascade');
            $table->string('amount')->default('0');
            $table->boolean('is_paid')->default(false);
            $table->string('rahgiri')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('pay_date')->nullable();
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
        Schema::dropIfExists('mostajer_factors');
    }
}
