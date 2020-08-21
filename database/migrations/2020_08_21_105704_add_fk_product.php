<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('fruit_id')->unsigned()->after('seller_id');
            $table->integer('sub_district_id')->unsigned()->after('fruit_id');

            $table->foreign('fruit_id')->references('id')->on('fruits')->onDelete('cascade');
            $table->foreign('sub_district_id')->references('id')->on('sub_districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
