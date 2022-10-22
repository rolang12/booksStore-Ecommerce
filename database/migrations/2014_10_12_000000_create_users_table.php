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
            $table->string('name','100');
            $table->string('last_name','100');
            $table->string('phone','10')->nullable();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->enum('profile', ['ADMIN', 'CLIENT'])->default('CLIENT');
            $table->enum('status', ['ACTIVE', 'LOCKED'])->default('ACTIVE');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
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
