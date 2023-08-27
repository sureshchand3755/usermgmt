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
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignId('user_type_id');
            $table->string('avatar')->nullable();
            $table->foreignId('position_id');
            $table->foreignId('department_id');
            $table->foreignId('country_id');
            $table->foreignId('state_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('deleted_at',1)->default('N');
            $table->rememberToken();
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
