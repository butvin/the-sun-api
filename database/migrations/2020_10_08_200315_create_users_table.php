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
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('role_id')->default(1);
            $table->boolean('status')->nullable()->default(0);
            $table->string('name', 255);
            $table->string('email', 320)->unique();
            $table->string('phone', 32)->nullable();
            $table->string('password');
            $table->string('fb_token', 100)->nullable();
            $table->string('gl_token', 100)->nullable();
            $table->string('api_token', 100)->nullable();
            $table->rememberToken();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

//        Schema::table('users',
//            fn($table) => $table->foreign('role_id')->references('id')->on('roles')
//        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', fn(Blueprint $table) => $table->dropSoftDeletes());
        Schema::dropIfExists('users');
    }
}
