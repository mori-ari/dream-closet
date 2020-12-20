<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreatePostsItemsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("posts_items", function (Blueprint $table) {
						$table->increments('id');
						$table->unsignedInteger('post_id')->nullable()->unsigned();
						$table->unsignedInteger('item_id')->nullable()->unsigned();
						$table->timestamps();
						

                    //*********************************
                    // Foreign KEY [ Uncomment if you want to use!! ]
                    //*********************************
                        //$table->foreign("post_id")->references("id")->on("posts");
						//$table->foreign("item_id")->references("id")->on("items");



						// ----------------------------------------------------
						// -- SELECT [posts_items]--
						// ----------------------------------------------------
						// $query = DB::table("posts_items")
						// ->leftJoin("posts","posts.id", "=", "posts_items.post_id")
						// ->leftJoin("items","items.id", "=", "posts_items.item_id")
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
                    Schema::dropIfExists("posts_items");
                }
            }
        