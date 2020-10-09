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
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('fb_token')->nullable();
            $table->string('gl_token')->nullable();
            $table->string('api token')->nullable();
            $table->integer('role_id')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
//            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('users', fn(Blueprint $table) => $table->dropSoftDeletes());
        Schema::dropIfExists('users');
    }
}
