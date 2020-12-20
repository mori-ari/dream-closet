<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreatePostsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("posts", function (Blueprint $table) {
						$table->increments('id');
						$table->string('uid',20)->nullable();
						$table->string('title',255)->nullable();
						$table->text('img1')->nullable();
						$table->text('img2')->nullable();
						$table->text('img3')->nullable();
						$table->text('img4')->nullable();
						$table->text('img5')->nullable();
						$table->text('img6')->nullable();
						$table->text('url1')->nullable();
						$table->text('url2')->nullable();
						$table->text('url3')->nullable();
						$table->text('url4')->nullable();
						$table->text('url5')->nullable();
						$table->text('url6')->nullable();
						$table->integer('price1')->nullable();
						$table->integer('price2')->nullable();
						$table->integer('price3')->nullable();
						$table->integer('price4')->nullable();
						$table->integer('price5')->nullable();
						$table->integer('price6')->nullable();
						$table->timestamps();
						$table->unique('uid');



						// ----------------------------------------------------
						// -- SELECT [posts]--
						// ----------------------------------------------------
						// $query = DB::table("posts")
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
                    Schema::dropIfExists("posts");
                }
            }
        