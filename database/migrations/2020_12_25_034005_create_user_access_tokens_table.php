<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();// One user from one token-access
            $table->string('token', 100)->unique();
            $table->boolean('status')->nullable();
            $table->timestamp('expires_at');
            $table->timestamps();
            //$table->foreign('user_id')->references('id')->on('user');
        });

        Schema::table('user_access_tokens', function (Blueprint $table) {
            $table->rememberToken()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_access_tokens');
    }
}
