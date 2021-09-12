<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','50');
            $table->string('email','50')->unique();
            $table->text('password');
            $table->string('image')->default('assets/upload/user/default.png')->nullable();
            $table->text('address','190')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('status')->default(true);
            $table->string('api_token')->unique();
            $table->rememberToken();
            $table->string('fcm_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('sellers');
    }
}
