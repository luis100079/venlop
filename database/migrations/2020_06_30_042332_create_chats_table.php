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

            $table->id();
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->longText('message');
            $table->boolean('seen')->default(false);
            $table->timestamps();

            $table->foreign('from')
                  ->references('id')
                  ->on('users')
                  ->cascade('Delete');

            $table->foreign('to')
                  ->references('id')
                  ->on('users')
                  ->cascade('Delete');
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
