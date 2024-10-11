<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
        Schema::create('question_groups_translation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_group_id')->unsigned();
            $table->string('title');
            $table->string('locale')->index();
            $table->unique(['question_group_id','locale']);
            $table->foreign('question_group_id')->references('id')->on('question_groups')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')->default(0);
            $table->enum('type', ['yn','choice', 'other']);
            $table->bigInteger('questionnaire_id')->unsigned();
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')->onDelete('cascade');
            $table->bigInteger('question_group_id')->unsigned();
            $table->foreign('question_group_id')->references('id')->on('question_groups')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('questions_translation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id')->unsigned();
            $table->string('question');
            $table->string('locale')->index();
            $table->unique(['question_id','locale']);
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id')->unsigned();
            $table->integer('point');
            $table->string('key');
            $table->boolean('show_textarea')->default(0);
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('answers_translation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('answer_id')->unsigned();
            $table->string('answer');
            $table->string('locale')->index();
            $table->unique(['answer_id','locale']);
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
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
        Schema::dropIfExists('answers_translation');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('questions_translation');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_groups_translation');
        Schema::dropIfExists('question_groups');
        

    }
}
