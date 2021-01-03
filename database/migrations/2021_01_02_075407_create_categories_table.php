<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('Lv1Id')->nullable();
			$table->string('Lv1Name')->nullable();    
			$table->integer('Lv2Id')->nullable();
			$table->string('Lv2Name')->nullable();
			$table->integer('Lv3Id')->nullable();
			$table->string('Lv3Name')->nullable();     
 			$table->integer('cateId')->nullable();
			$table->string('cateJp')->nullable(); 
			$table->string('cateEn')->nullable();     

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
        Schema::dropIfExists('categories');
    }
}
