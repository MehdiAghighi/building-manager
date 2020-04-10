<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('borj_id')->nullable();
            $table->foreign('borj_id')->references('id')->on('borjs')->onDelete('cascade');
            $table->unsignedBigInteger('mostajer_id')->nullable();
            $table->foreign('mostajer_id')->references('id')->on('mostajers')->onDelete('cascade');
            $table->string('title');
            $table->text('text')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('chats');
    }
}
