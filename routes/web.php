<?php
use Illuminate\Http\Response;

//default
Route::get("/", function () {
    return view("welcome");
});
//Demo (Delete after site publish.)
Route::get("/tables_check_view_html",function(){
    return view("tables_check_view_html");
});


//=======================================================================
//index
Route::get("user/", "UsersController@index");
//create
Route::get("user/create", "UsersController@create");
//show
Route::get("user/{id}", "UsersController@show");
//store
Route::post("user/store", "UsersController@store");
//edit
Route::get("user/{id}/edit", "UsersController@edit");
//update
Route::put("user/{id}", "UsersController@update");
//destroy
Route::delete("user/{id}", "UsersController@destroy");
//=======================================================================

//=======================================================================
//index
Route::get("password_reset/", "PasswordResetsController@index");
//create
Route::get("password_reset/create", "PasswordResetsController@create");
//show
Route::get("password_reset/{id}", "PasswordResetsController@show");
//store
Route::post("password_reset/store", "PasswordResetsController@store");
//edit
Route::get("password_reset/{id}/edit", "PasswordResetsController@edit");
//update
Route::put("password_reset/{id}", "PasswordResetsController@update");
//destroy
Route::delete("password_reset/{id}", "PasswordResetsController@destroy");
//=======================================================================

//=======================================================================
//index
Route::get("failed_job/", "FailedJobsController@index");
//create
Route::get("failed_job/create", "FailedJobsController@create");
//show
Route::get("failed_job/{id}", "FailedJobsController@show");
//store
Route::post("failed_job/store", "FailedJobsController@store");
//edit
Route::get("failed_job/{id}/edit", "FailedJobsController@edit");
//update
Route::put("failed_job/{id}", "FailedJobsController@update");
//destroy
Route::delete("failed_job/{id}", "FailedJobsController@destroy");
//=======================================================================

//=======================================================================
//index
Route::get("post/", "PostsController@index");
//create
Route::get("post/create", "PostsController@create");
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
//index
Route::get("item/", "ItemsController@index");
//create
Route::get("item/create", "ItemsController@create");
//show
Route::get("item/{id}", "ItemsController@show");
//store
Route::post("item/store", "ItemsController@store");
//edit
Route::get("item/{id}/edit", "ItemsController@edit");
//update
Route::put("item/{id}", "ItemsController@update");
//destroy
Route::delete("item/{id}", "ItemsController@destroy");
//=======================================================================

//=======================================================================
//index
Route::get("posts_item/", "PostsItemsController@index");
//create
Route::get("posts_item/create", "PostsItemsController@create");
//show
Route::get("posts_item/{id}", "PostsItemsController@show");
//store
Route::post("posts_item/store", "PostsItemsController@store");
//edit
Route::get("posts_item/{id}/edit", "PostsItemsController@edit");
//update
Route::put("posts_item/{id}", "PostsItemsController@update");
//destroy
Route::delete("posts_item/{id}", "PostsItemsController@destroy");
//=======================================================================
