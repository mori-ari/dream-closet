<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenreIdToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->integer('genre6')->nullable()->after('price6');
            $table->integer('genre5')->nullable()->after('price6');
            $table->integer('genre4')->nullable()->after('price6');
            $table->integer('genre3')->nullable()->after('price6');
            $table->integer('genre2')->nullable()->after('price6');
            $table->integer('genre1')->nullable()->after('price6');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            

        });
    }
}
