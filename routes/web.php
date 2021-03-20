<?php
use Illuminate\Http\Response;

//default
// Route::get("/", function () {
//     return view("welcome");
// });
//Demo (Delete after site publish.)
// Route::get("/tables_check_view_html",function(){
//     return view("tables_check_view_html");
// });



// //=======================================================================
// //index
// Route::get("user/", "UsersController@index");
// //create
// Route::get("user/create", "UsersController@create");
// //show
// Route::get("user/{id}", "UsersController@show");
// //store
// Route::post("user/store", "UsersController@store");
// //edit
// Route::get("user/{id}/edit", "UsersController@edit");
// //update
// Route::put("user/{id}", "UsersController@update");
// //destroy
// Route::delete("user/{id}", "UsersController@destroy");
// //=======================================================================

// //=======================================================================
// //index
// Route::get("password_reset/", "PasswordResetsController@index");
// //create
// Route::get("password_reset/create", "PasswordResetsController@create");
// //show
// Route::get("password_reset/{id}", "PasswordResetsController@show");
// //store
// Route::post("password_reset/store", "PasswordResetsController@store");
// //edit
// Route::get("password_reset/{id}/edit", "PasswordResetsController@edit");
// //update
// Route::put("password_reset/{id}", "PasswordResetsController@update");
// //destroy
// Route::delete("password_reset/{id}", "PasswordResetsController@destroy");
// //=======================================================================

// //=======================================================================
// //index
// Route::get("failed_job/", "FailedJobsController@index");
// //create
// Route::get("failed_job/create", "FailedJobsController@create");
// //show
// Route::get("failed_job/{id}", "FailedJobsController@show");
// //store
// Route::post("failed_job/store", "FailedJobsController@store");
// //edit
// Route::get("failed_job/{id}/edit", "FailedJobsController@edit");
// //update
// Route::put("failed_job/{id}", "FailedJobsController@update");
// //destroy
// Route::delete("failed_job/{id}", "FailedJobsController@destroy");
// //=======================================================================

//=======================================================================
//index
// Route::get("post/", "PostsController@index");
Route::get("/", "PostsController@index");
//create
Route::get("post/", "PostsController@create");
//show
Route::get("post/{uid}", "PostsController@show");
//store
Route::post("post/store", "PostsController@store");
//edit
Route::get("post/{id}/edit", "PostsController@edit");
//update
Route::put("post/{id}", "PostsController@update");
//destroy
Route::delete("post/{id}", "PostsController@destroy");
//=======================================================================

//=======================================================================
// 楽天API
Route::get("item/1", "ItemsController@apartbylowrys");
Route::get("item/2", "ItemsController@bcstock");
Route::get("item/3", "ItemsController@beams");
Route::get("item/4", "ItemsController@beamsoutlet");
Route::get("item/5", "ItemsController@beautyandyouth");
Route::get("item/6", "ItemsController@coen");
Route::get("item/7", "ItemsController@converse");
Route::get("item/8", "ItemsController@ehyphen");
Route::get("item/9", "ItemsController@earth1999");
Route::get("item/10", "ItemsController@etestore");

Route::get("item/11", "ItemsController@frayid");
Route::get("item/12", "ItemsController@freesmart");
Route::get("item/13", "ItemsController@globalwork");
Route::get("item/14", "ItemsController@heather");
Route::get("item/15", "ItemsController@shopined");
Route::get("item/16", "ItemsController@ingnishop");
Route::get("item/17", "ItemsController@jeanasis");
Route::get("item/18", "ItemsController@jadorejunonline");
Route::get("item/19", "ItemsController@jillbyjillstuart");
Route::get("item/20", "ItemsController@jillstuart");

Route::get("item/21", "ItemsController@jouetestore");
Route::get("item/22", "ItemsController@katespadenewyork");
Route::get("item/23", "ItemsController@kbfrba");
Route::get("item/24", "ItemsController@kumikyoku");
Route::get("item/25", "ItemsController@lilybrown");
Route::get("item/26", "ItemsController@lowrysfarm");
Route::get("item/27", "ItemsController@mackintoshlondon");
Route::get("item/28", "ItemsController@mackintoshphilosophy");
Route::get("item/29", "ItemsController@majesticlegon");
Route::get("item/30", "ItemsController@milaowen");
            
Route::get("item/31", "ItemsController@milkfed");
Route::get("item/32", "ItemsController@mystywomanshop");
Route::get("item/33", "ItemsController@nano-universe");
Route::get("item/34", "ItemsController@naturalbeautybasic");
Route::get("item/35", "ItemsController@nikoand");
Route::get("item/36", "ItemsController@odetteeodile");
Route::get("item/37", "ItemsController@pageboyshop");
Route::get("item/38", "ItemsController@palgroupoutlet");
Route::get("item/39", "ItemsController@pinkyanddianne");
Route::get("item/40", "ItemsController@proportionbodydressing");
            
Route::get("item/41", "ItemsController@shopraycassin");
Route::get("item/42", "ItemsController@ropepicnic");
Route::get("item/43", "ItemsController@rosebud");
Route::get("item/44", "ItemsController@sm2can");
Route::get("item/45", "ItemsController@samanthathavasa");
Route::get("item/46", "ItemsController@sanyoselect");
Route::get("item/47", "ItemsController@sheltterwebstore");
Route::get("item/48", "ItemsController@ships");
Route::get("item/49", "ItemsController@snidel");
Route::get("item/50", "ItemsController@thevirgnia");
            
Route::get("item/51", "ItemsController@unitedarrows");
Route::get("item/52", "ItemsController@greenlabelrelaxing");
Route::get("item/53", "ItemsController@unitedarrowsltdoutlet");
Route::get("item/54", "ItemsController@doorsrba");
Route::get("item/55", "ItemsController@urrba");
Route::get("item/56", "ItemsController@uritems");
Route::get("item/57", "ItemsController@rossorba");
Route::get("item/58", "ItemsController@usonlinestore");
Route::get("item/59", "ItemsController@usagionline");
Route::get("item/60", "ItemsController@visjun");

Route::get("item/61", "ItemsController@xgirl");
            

            

//=======================================================================

//=======================================================================
// //index
// Route::get("posts_item/", "PostsItemsController@index");
// //create
// Route::get("posts_item/create", "PostsItemsController@create");
// //show
// Route::get("posts_item/{id}", "PostsItemsController@show");
// //store
// Route::post("posts_item/store", "PostsItemsController@store");
//edit
// Route::get("posts_item/{id}/edit", "PostsItemsController@edit");
//update
// Route::put("posts_item/{id}", "PostsItemsController@update");
//destroy
// Route::delete("posts_item/{id}", "PostsItemsController@destroy");
//=======================================================================
