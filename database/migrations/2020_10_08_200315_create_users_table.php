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
            $table->integer('role_id')->default(1);
            $table->string('name', 255);
            $table->string('email', 320)->unique();
            $table->string('phone', 64)->nullable();
            $table->string('password');
            $table->boolean('status')->nullable();
            $table->string('fb_token')->nullable();
            $table->string('gl_token')->nullable();
            $table->string('api_token')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
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
