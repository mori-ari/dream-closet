<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Validate;
use DB;
use App\Item;
    
    //=======================================================================
    class ItemsController extends Controller
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
				// -- QueryBuilder: SELECT [items]--
				// ----------------------------------------------------
				$item = DB::table("items")
				->orWhere("items.itemCode", "LIKE", "%$keyword%")->orWhere("items.url", "LIKE", "%$keyword%")->orWhere("items.img", "LIKE", "%$keyword%")->orWhere("items.price", "LIKE", "%$keyword%")->orWhere("items.genreId", "LIKE", "%$keyword%")->orWhere("items.genreName", "LIKE", "%$keyword%")->orWhere("items.colorId", "LIKE", "%$keyword%")->orWhere("items.colorName", "LIKE", "%$keyword%")->orWhere("items.shopName", "LIKE", "%$keyword%")->orWhere("items.shopUrl", "LIKE", "%$keyword%")->orWhere("items.itemName", "LIKE", "%$keyword%")->orWhere("items.caption", "LIKE", "%$keyword%")->select("*")->addSelect("items.id")->paginate($perPage);
            } else {
                    //$item = Item::paginate($perPage);
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [items]--
				// ----------------------------------------------------
				$item = DB::table("items")
				->select("*")->addSelect("items.id")->paginate($perPage);              
            }          
            return view("item.index", compact("item"));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\View\View
         */
        public function create()
        {
            return view("item.create");
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
				"itemCode" => "required|integer", //integer('itemCode')
				"url" => "nullable", //text('url')->nullable()
				"img" => "nullable", //text('img')->nullable()
				"price" => "nullable|integer", //integer('price')->nullable()
				"genreId" => "nullable|integer", //integer('genreId')->nullable()
				"genreName" => "nullable", //string('genreName')->nullable()
				"colorId" => "nullable|integer", //integer('colorId')->nullable()
				"colorName" => "nullable", //string('colorName')->nullable()
				"shopName" => "nullable", //string('shopName')->nullable()
				"shopUrl" => "nullable", //text('shopUrl')->nullable()
				"itemName" => "nullable", //text('itemName')->nullable()
				"caption" => "nullable", //text('caption')->nullable()

            ]);
            $requestData = $request->all();
            
            Item::create($requestData);
    
            return redirect("item")->with("flash_message", "item added!");
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
            //$item = Item::findOrFail($id);
            
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [items]--
				// ----------------------------------------------------
				$item = DB::table("items")
				->select("*")->addSelect("items.id")->where("items.id",$id)->first();
            return view("item.show", compact("item"));
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
            $item = Item::findOrFail($id);
    
            return view("item.edit", compact("item"));
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
				"itemCode" => "required|integer", //integer('itemCode')
				"url" => "nullable", //text('url')->nullable()
				"img" => "nullable", //text('img')->nullable()
				"price" => "nullable|integer", //integer('price')->nullable()
				"genreId" => "nullable|integer", //integer('genreId')->nullable()
				"genreName" => "nullable", //string('genreName')->nullable()
				"colorId" => "nullable|integer", //integer('colorId')->nullable()
				"colorName" => "nullable", //string('colorName')->nullable()
				"shopName" => "nullable", //string('shopName')->nullable()
				"shopUrl" => "nullable", //text('shopUrl')->nullable()
				"itemName" => "nullable", //text('itemName')->nullable()
				"caption" => "nullable", //text('caption')->nullable()

            ]);
            $requestData = $request->all();
            
            $item = Item::findOrFail($id);
            $item->update($requestData);
    
            return redirect("item")->with("flash_message", "item updated!");
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
            Item::destroy($id);
    
            return redirect("item")->with("flash_message", "item deleted!");
        }
    }
    //=======================================================================
    
    