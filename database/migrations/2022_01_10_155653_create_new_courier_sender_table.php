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
            $table->string('location')->nullable();
            $table->string('docket_no')->nullable();
            $table->string('docket_date')->nullable();
            $table->string('telephone_no')->nullable();
            $table->string('courier_name')->nullable();
            $table->string('bill')->nullable();
            $table->string('amount')->nullable();
            $table->string('kyc')->nullable();
            $table->string('month')->nullable();
            $table->string('from')->nullable();
            $table->string('for')->nullable();
            $table->string('financial')->nullable();
            $table->string('catagories')->nullable();
            $table->string('given_to')->nullable();
            $table->string('checked_by')->nullable();
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
