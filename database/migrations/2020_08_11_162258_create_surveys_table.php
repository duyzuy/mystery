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
            $table->bigInteger('store_id')->unsigned();
            $table->bigInteger('total_point')->unsigned();
            $table->string('address')->nullable();
            $table->string('staff_name')->nullable();
            $table->string('manager_name')->nullable();
            $table->dateTime('dinner_time');
            $table->longText('feedback')->nullable();
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
