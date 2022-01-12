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
            $table->string('name_company')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('distt')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('docket_no')->nullable();
            $table->string('docket_date')->nullable();
            $table->string('document')->nullable();
            $table->string('telephone_no')->nullable();
            $table->string('courier_name')->nullable();
            $table->string('given_to')->nullable();
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
