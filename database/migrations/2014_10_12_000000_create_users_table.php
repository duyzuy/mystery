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
            $table->string('phone_number');
            $table->string('address')->nullable();
            $table->bigInteger('region_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('store_id')->unsigned();
            $table->string('token')->nullable();
            $table->boolean('actived')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('user_type', ['register', 'subcriber', 'customer']);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        
       
      
       
    }
}
