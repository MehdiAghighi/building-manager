<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMostajersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mostajers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('phone');
            $table->unsignedBigInteger('borj_id')->nullable();
            $table->foreign('borj_id')->references('id')->on('borjs')->onDelete('cascade');
            $table->string('sharj_amount')->nullable();
            $table->integer('vahed')->nullable();
            $table->integer('tabaghe')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mostajers');
    }
}
