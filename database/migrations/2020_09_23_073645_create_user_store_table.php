<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_store', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->json('stores');
            $table->bigInteger('store_id')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->dateTime('check_in')->nullable();
            $table->enum('response_status', ['waiting', 'cancel', 'accept', 'completed'])->default('waiting');
            $table->string('token')->nullable();
            $table->string('locale');
            $table->bigInteger('survey_id')->nullable();
            $table->integer('registration_count')->default(1);
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
        Schema::dropIfExists('user_store');
    }
}
