<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TranslationsThird extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id')->unsigned();
        
            $table->string('locale')->index();
        
            $table->string('title');
        
            $table->unique(['category_id','locale']);
        
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
        
        Schema::create('tag_translations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('tag_id')->unsigned();
        
            $table->string('locale')->index();
        
            $table->string('title');
        
            $table->unique(['tag_id','locale']);
        
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::create('ingredient_translations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('ingredient_id')->unsigned();
        
            $table->string('locale')->index();
        
            $table->string('title');
        
            $table->unique(['ingredient_id','locale']);
        
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
