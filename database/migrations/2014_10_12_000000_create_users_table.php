<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('gender')->nullable();
            $table->boolean('avatar')->default(0);
            $table->string('profession')->nullable();

            $table->string('address')->nullable();
            $table->string('m_status')->nullable();
            $table->string('interested_in')->nullable();
            $table->LongText('about_me')->nullable();
            $table->string('age')->nullable();
            $table->date('birth')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('country')->nullable();
            $table->string('tel')->nullable();

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
        Schema::dropIfExists('users');
    }
}
