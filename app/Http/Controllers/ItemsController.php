<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Validate;
use DB;
use App\Item;

//忘れずにuseしておきましょう
use RakutenRws_Client;




    
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
				// $item = DB::table("items")　//stdClassエラー回避のためコメントアウトし下記1行追加
				$item = Item::query()
				->orWhere("items.itemCode", "LIKE", "%$keyword%")->orWhere("items.url", "LIKE", "%$keyword%")->orWhere("items.img", "LIKE", "%$keyword%")->orWhere("items.price", "LIKE", "%$keyword%")->orWhere("items.genreId", "LIKE", "%$keyword%")->orWhere("items.genreName", "LIKE", "%$keyword%")->orWhere("items.colorId", "LIKE", "%$keyword%")->orWhere("items.colorName", "LIKE", "%$keyword%")->orWhere("items.shopName", "LIKE", "%$keyword%")->orWhere("items.shopUrl", "LIKE", "%$keyword%")->orWhere("items.itemName", "LIKE", "%$keyword%")->orWhere("items.caption", "LIKE", "%$keyword%")->select("*")->addSelect("items.id")->paginate($perPage);
            } else {
                    //$item = Item::paginate($perPage);
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [items]--
				// ----------------------------------------------------
				$item = DB::table("items")
				// $item = Item::query()　メンターさんから頂いた記述
				->select("*")->addSelect("items.id")->paginate($perPage);

            }
            
             return view("item.index", compact("item"));
             
             dd($items);
                    
        
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\View\View
         */
        public function create()
        {
                        // -------------------
            // 楽天
            // -------------------
            
            //楽天APIを扱うRakutenRws_Clientクラスのインスタンスを作成します
        $client = new RakutenRws_Client();

        //定数化
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        //アプリIDをセット！
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        // アフィリエイトIDをセット (任意) Set Affiliate ID (Optional)
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        // Secret をセットします（認証が必要な場合）
        // $client->setSecret(RAKUTEN_APPLICATION_SEACRET);
        

// -------------------------------------------------------------
$maxpage = 10;
// 元（30件までは取得できる記述）IchibaItem/Search API
for($i=1; $i<=$maxpage; $i++){

        $response[] = $client->execute('IchibaItemSearch', array(
          'genreId' => '100371',
          'page' => $i,        
          'hits' => 30,
          'imageFlag' => 1
        ));

}

//  dd($response);
 
 
 foreach ($response as $key => $val) {
            foreach ($val as $item){
            $items[] = array(
                'itemCode' => $item['itemCode'],
                'url' => $item['itemUrl'],
                'img' => $item['mediumImageUrls'][0]['imageUrl'],
                'price' => $item['itemPrice'],
                'genreId' => $item['genreId'],
                // 'genreName' => $item['genreName'],
                // 'colorId' => $item['tagGroupId'],
                // 'colorName' => $item['tagName'],
                'shopName' => $item['shopName'],
                'shopUrl' => $item['shopUrl'],
                'itemName' => $item['itemName'],
                'caption' => $item['itemCaption'],
            
            );
 }
 }
           dd($items);

















        // レスポンスが正しいかを isOk() で確認することができます
        // if (! $response->isOk()) {
        //     return'Error:'.$response->getMessage();
        // } else {
            
                    $items = array();
        // 配列で結果をぶち込んで行きます
        foreach ($response as $item){
            //画像サイズを変えたかったのでURLを整形します
            // $str = str_replace("_ex=128x128", "_ex=175x175", $item['mediumImageUrls'][0]['imageUrl']);
            $items[] = array(
                'itemCode' => $item['itemCode'],
                'url' => $item['itemUrl'],
                'img' => $item['mediumImageUrls'][0]['imageUrl'],
                'price' => $item['itemPrice'],
                'genreId' => $item['genreId'],
                // 'genreName' => $item['genreName'],
                // 'colorId' => $item['tagGroupId'],
                // 'colorName' => $item['tagName'],
                'shopName' => $item['shopName'],
                'shopUrl' => $item['shopUrl'],
                'itemName' => $item['itemName'],
                'caption' => $item['itemCaption'],
            
            );
            
        //  }
         
        
        

        //  dd($items);
            
            
        } 
            // return view("item.create");
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
    //         $this->validate($request, [
				// // "itemCode" => "required|integer", //integer('itemCode')
				// "itemCode" => "nullable", ///string('itemCode')
				// "url" => "nullable", //text('url')->nullable()
				// "img" => "nullable", //text('img')->nullable()
				// "price" => "nullable|integer", //integer('price')->nullable()
				// "genreId" => "nullable|integer", //integer('genreId')->nullable()
				// "genreName" => "nullable", //string('genreName')->nullable()
				// "colorId" => "nullable|integer", //integer('colorId')->nullable()
				// "colorName" => "nullable", //string('colorName')->nullable()
				// "shopName" => "nullable", //string('shopName')->nullable()
				// "shopUrl" => "nullable", //text('shopUrl')->nullable()
				// "itemName" => "nullable", //text('itemName')->nullable()
				// "caption" => "nullable", //text('caption')->nullable()

    //         ]);
    //         $requestData = $request->all();
            
    //         Item::create($requestData);
            
            // -------------------
            // 楽天
            // -------------------
            
            //楽天APIを扱うRakutenRws_Clientクラスのインスタンスを作成します
        $client = new RakutenRws_Client();

        //定数化
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        //アプリIDをセット！
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        // アフィリエイトIDをセット (任意) Set Affiliate ID (Optional)
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        // Secret をセットします（認証が必要な場合）
        // $client->setSecret(RAKUTEN_APPLICATION_SEACRET);
        

// -------------------------------------------------------------
$maxpage = 100;


// 元（30件までは取得できる記述）IchibaItem/Search API
// for($i=1; $i<=$maxpage; $i++){

        $response = $client->execute('IchibaItemSearch', array(
          'genreId' => '100371',
          'page' => $i,        
          'hits' => 30,
          'imageFlag' => 1
        ));
// }

        // レスポンスが正しいかを isOk() で確認することができます
        if (! $response->isOk()) {
            return'Error:'.$response->getMessage();
        } else {
                    $items = array();
        // 配列で結果をぶち込んで行きます
        foreach ($response as $item){
            //画像サイズを変えたかったのでURLを整形します
            // $str = str_replace("_ex=128x128", "_ex=175x175", $item['mediumImageUrls'][0]['imageUrl']);
            $items[] = array(
                'itemCode' => $item['itemCode'],
                'url' => $item['itemUrl'],
                'img' => $item['mediumImageUrls'][0]['imageUrl'],
                'price' => $item['itemPrice'],
                'genreId' => $item['genreId'],
                // 'genreName' => $item['genreName'],
                // 'colorId' => $item['tagGroupId'],
                // 'colorName' => $item['tagName'],
                'shopName' => $item['shopName'],
                'shopUrl' => $item['shopUrl'],
                'itemName' => $item['itemName'],
                'caption' => $item['itemCaption'],
            
            );
            
         }
         
         
            // Eloquent モデル storeでエラーになる。ので全部消した
            // $datas = new Item;
            // $datas->itemCode = $items['itemCode']; エラーになる。型変えたから？
            // $datas->url =  $items['url'];
            // $datas->price = $items['price'];
            // $datas->genreId = $items['genreId'];
            // // $datas->genreName = $items['genreName'];
            // // $datas->colorId = $items['colorId'];
            // // $datas->colorName =$items['colorName'];
            // $datas->shopName = $items['shopName'];
            // $datas->shopUrl = $items['shopUrl'];
            // $datas->caption = $items['caption'];
            // $datas->save(); 
            
            dd($items);
            
            // return redirect("item")->with("flash_message", "item added!");
            
        }
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
            // $item = Item::findOrFail($id);
            
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [items]--
				// ----------------------------------------------------
				// $item = DB::table("items")　//stdClassエラー回避のためコメントアウトし下記1行追加
				$item = Item::query()
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
			 // "itemCode" => "required|integer", //integer('itemCode')
				"itemCode" => "nullable", ///string('itemCode')
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
    
    