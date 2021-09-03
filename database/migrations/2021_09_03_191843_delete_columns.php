<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn(['title','description']);
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
