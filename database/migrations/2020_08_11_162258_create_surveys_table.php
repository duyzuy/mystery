<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('questionnaire_id')->unsigned();
            $table->bigInteger('region_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('store_id')->unsigned();
            $table->string('receipt_number')->nullable();
            $table->bigInteger('total_point')->unsigned();
            $table->string('staff_name')->nullable();
            $table->string('manager_name')->nullable();
            $table->dateTime('dinner_time');
            $table->string('bank_name')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_address')->nullable();
            $table->longText('feedback')->nullable();
            $table->boolean('viewed')->default(0);
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
        Schema::dropIfExists('surveys');
    }
}
