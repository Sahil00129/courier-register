<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewCourierSenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_courier_sender', function (Blueprint $table) {
            $table->id();
            $table->string('name_company');
            $table->string('address');
            $table->string('city');
            $table->string('distt');
            $table->string('pin_code');
            $table->string('document');
            $table->string('telephone_no');
            $table->string('courier_name');
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
        Schema::dropIfExists('new_courier_sender');
    }
}
