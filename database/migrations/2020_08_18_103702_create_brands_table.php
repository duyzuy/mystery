<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->char('code', 10);
        });
        Schema::create('regions_translation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('region_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['region_id','locale']);
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });

       
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->integer('city_code')->nullable();
            $table->timestamps();
        });
        Schema::create('cities_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('city_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['city_id','locale']);
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_website');
            $table->string('store_image');
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('stores_translation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id')->unsigned();
            $table->string('locale')->index();
            $table->string('store_name');
            $table->text('store_address');
            $table->longText('store_description')->nullable();
            $table->unique(['store_id','locale']);
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
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
       
        
        Schema::dropIfExists('stores_translation');
        Schema::dropIfExists('stores');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('cities_translations');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('regions_translation');
        Schema::dropIfExists('regions');
    }
}
