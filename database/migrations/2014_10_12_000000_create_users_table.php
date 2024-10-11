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
    public function up()
    {
     

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->date('day_of_birth');
            $table->string('phone_number');
            $table->enum('gender', ['male','female', 'other']);
            $table->string('address')->nullable();
            $table->string('token')->nullable();
            $table->boolean('actived')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('user_type', ['register', 'subcriber', 'customer']);
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('signup_questions', function (Blueprint $table) {
            $table->id();           
       
        });

        Schema::create('signup_questions_translation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('signup_question_id')->unsigned();
            $table->string('locale')->index();
            $table->string('questions');
            $table->unique(['signup_question_id','locale']);
            $table->foreign('signup_question_id')->references('id')->on('signup_questions')->onDelete('cascade');
     
        });

        Schema::create('signup_response', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('signup_question_id')->unsigned();
            $table->foreign('signup_question_id')->references('id')->on('signup_questions')->onDelete('cascade');
            $table->text('answer')->nullable();
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signup_response');
        Schema::dropIfExists('signup_questions_translation');
        Schema::dropIfExists('signup_questions');
        Schema::dropIfExists('users');


    }
}
