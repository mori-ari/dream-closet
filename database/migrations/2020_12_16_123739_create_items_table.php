<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateItemsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("items", function (Blueprint $table) {
						$table->increments('id');
						$table->string('itemCode')->nullable();
						$table->text('url')->nullable();
						$table->text('img')->nullable();
						$table->integer('price')->nullable();
						$table->integer('genreId')->nullable();
						$table->string('genreName')->nullable();
						$table->integer('colorId')->nullable();
						$table->string('colorName')->nullable();
						$table->string('shopName')->nullable();
						$table->text('shopUrl')->nullable();
						$table->text('itemName')->nullable();
						$table->text('caption')->nullable();
						$table->timestamps();



						// ----------------------------------------------------
						// -- SELECT [items]--
						// ----------------------------------------------------
						// $query = DB::table("items")
						// ->get();
						// dd($query); //For checking



                    });
                }
    
                /**
                 * Reverse the migrations.
                 *
                 * @return void
                 */
                public function down()
                {
                    Schema::dropIfExists("items");
                }
            }
        