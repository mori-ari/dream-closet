<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Validate;
use DB;
use App\PostsItem;
    
    //=======================================================================
    class PostsItemsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\View\View
         */
        public function index(Request $request)
        {
            $keyword = $request->get("search");
            $perPage = 25;
    
            if (!empty($keyword)) {
                
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [posts_items]--
				// ----------------------------------------------------
				$posts_item = DB::table("posts_items")
				->leftJoin("posts","posts.id", "=", "posts_items.post_id")
				->leftJoin("items","items.id", "=", "posts_items.item_id")
				->orWhere("posts_items.post_id", "LIKE", "%$keyword%")->orWhere("posts_items.item_id", "LIKE", "%$keyword%")->orWhere("posts.uid", "LIKE", "%$keyword%")->orWhere("posts.title", "LIKE", "%$keyword%")->orWhere("posts.img1", "LIKE", "%$keyword%")->orWhere("posts.img2", "LIKE", "%$keyword%")->orWhere("posts.img3", "LIKE", "%$keyword%")->orWhere("posts.img4", "LIKE", "%$keyword%")->orWhere("posts.img5", "LIKE", "%$keyword%")->orWhere("posts.img6", "LIKE", "%$keyword%")->orWhere("posts.url1", "LIKE", "%$keyword%")->orWhere("posts.url2", "LIKE", "%$keyword%")->orWhere("posts.url3", "LIKE", "%$keyword%")->orWhere("posts.url4", "LIKE", "%$keyword%")->orWhere("posts.url5", "LIKE", "%$keyword%")->orWhere("posts.url6", "LIKE", "%$keyword%")->orWhere("posts.price1", "LIKE", "%$keyword%")->orWhere("posts.price2", "LIKE", "%$keyword%")->orWhere("posts.price3", "LIKE", "%$keyword%")->orWhere("posts.price4", "LIKE", "%$keyword%")->orWhere("posts.price5", "LIKE", "%$keyword%")->orWhere("posts.price6", "LIKE", "%$keyword%")->orWhere("items.itemCode", "LIKE", "%$keyword%")->orWhere("items.url", "LIKE", "%$keyword%")->orWhere("items.img", "LIKE", "%$keyword%")->orWhere("items.price", "LIKE", "%$keyword%")->orWhere("items.genreId", "LIKE", "%$keyword%")->orWhere("items.genreName", "LIKE", "%$keyword%")->orWhere("items.colorId", "LIKE", "%$keyword%")->orWhere("items.colorName", "LIKE", "%$keyword%")->orWhere("items.shopName", "LIKE", "%$keyword%")->orWhere("items.shopUrl", "LIKE", "%$keyword%")->orWhere("items.itemName", "LIKE", "%$keyword%")->orWhere("items.caption", "LIKE", "%$keyword%")->select("*")->addSelect("posts_items.id")->paginate($perPage);
            } else {
                    //$posts_item = PostsItem::paginate($perPage);
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [posts_items]--
				// ----------------------------------------------------
				$posts_item = DB::table("posts_items")
				->leftJoin("posts","posts.id", "=", "posts_items.post_id")
				->leftJoin("items","items.id", "=", "posts_items.item_id")
				->select("*")->addSelect("posts_items.id")->paginate($perPage);              
            }          
            return view("posts_item.index", compact("posts_item"));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\View\View
         */
        public function create()
        {
            return view("posts_item.create");
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function store(Request $request)
        {
            $this->validate($request, [
				"post_id" => "nullable|integer", //unsignedInteger('post_id')->nullable()
				"item_id" => "nullable|integer", //unsignedInteger('item_id')->nullable()

            ]);
            $requestData = $request->all();
            
            PostsItem::create($requestData);
    
            return redirect("posts_item")->with("flash_message", "posts_item added!");
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
        public function show($id)
        {
            //$posts_item = PostsItem::findOrFail($id);
            
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [posts_items]--
				// ----------------------------------------------------
				$posts_item = DB::table("posts_items")
				->leftJoin("posts","posts.id", "=", "posts_items.post_id")
				->leftJoin("items","items.id", "=", "posts_items.item_id")
				->select("*")->addSelect("posts_items.id")->where("posts_items.id",$id)->first();
            return view("posts_item.show", compact("posts_item"));
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
        public function edit($id)
        {
            $posts_item = PostsItem::findOrFail($id);
    
            return view("posts_item.edit", compact("posts_item"));
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  int  $id
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function update(Request $request, $id)
        {
            $this->validate($request, [
				"post_id" => "nullable|integer", //unsignedInteger('post_id')->nullable()
				"item_id" => "nullable|integer", //unsignedInteger('item_id')->nullable()

            ]);
            $requestData = $request->all();
            
            $posts_item = PostsItem::findOrFail($id);
            $posts_item->update($requestData);
    
            return redirect("posts_item")->with("flash_message", "posts_item updated!");
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function destroy($id)
        {
            PostsItem::destroy($id);
    
            return redirect("posts_item")->with("flash_message", "posts_item deleted!");
        }
    }
    //=======================================================================
    
    