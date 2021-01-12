<?php
namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Validate;
use DB;
use App\Item;
use App\Post;
//楽天
use RakutenRws_Client;
// insertでtimestamp入れる $ composer require nesbot/carbon 入れた
use Carbon\Carbon;


    
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
            $perPage = 1000;
    
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
    // -------------------
    // 楽天
    // -------------------

        //楽天APIを扱うRakutenRws_Clientクラスのインスタンスを作成
        $client = new RakutenRws_Client();

        //定数化
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));

        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        // 認証が必要な場合
        // $client->setSecret(RAKUTEN_APPLICATION_SEACRET);
        //処理時間無制限に設定　https://www.freemen.jp/sys/php/679
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        // -------------------------------------------------------------

        $genreArrey = [
            '555086',
            '555089',
            '110729',
            '555083',
            '555087',
            '100480',
            '110933',
            '110974',
            '403732',
            '207204',
            '110894',
            '560100',
            '403755',
            '403762',
            '207306',
            '100486',
            ];
            


        $shopArrey= [
            // 'apartbylowrys',
            // 'bcstock',
            // 'beams',
            // 'beams-outlet',
            // 'beautyandyouth',
            // 'coen',
            // 'converse',
            'ehyphen',
            'earth1999',
            'ete-store',
            'frayid',
            'freesmart',
            'globalwork',
            'heather',
            'shop-ined',
            'ingni-shop',
            'jeanasis',
            'jadorejunonline',
            'jillbyjillstuart',
            'jillstuart',
            'jouete-store',
            'katespadenewyork',
            'kbf-rba',
            'kumikyoku',
            'lilybrown',
            'lowrysfarm',
            'mackintoshlondon',
            'mackintoshphilosophy',
            'majesticlegon',
            'milaowen',
            'milkfed',
            'mystywoman-shop',
            'nano-universe',
            'naturalbeautybasic',
            'nikoand',
            'odetteeodile',
            'pageboy-shop',
            'palgroupoutlet',
            'pinkyanddianne',
            'proportionbodydressing',
            'shop-raycassin',
            'ropepicnic',
            'rosebud',
            'sm2-can',
            'samanthathavasa',
            'sanyoselect',
            'sheltter-webstore',
            'ships',
            'snidel',
            'thevirgnia',
            'unitedarrows',
            'greenlabelrelaxing',
            'unitedarrowsltdoutlet',
            'doors-rba',
            'ur-rba',
            'ur-items',
            'rosso-rba',
            'usonlinestore',
            'usagi-online',
            'vis-jun',
            'xgirl'
        ];
    
        foreach ($shopArrey as $key => $shopCode) {        
            foreach ($genreArrey as $key => $genreId) {
                
                $maxpage =1;
        
                for($i=1; $i<=$maxpage; $i++){
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => $shopCode,
                              'genreId' => $genreId,
                              'page' => $i,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                            }
                
                 foreach ($response as $key => $val) {
                        // レスポンスが正しいかを isOk() で確認することができます
                        // if (! $response->isOk()) {
                        //     return'Error:'.$response->getMessage();
                        // } else {
                        
                            foreach ($val as $item){
                                //画像サイズを変えたかったのでURLを整形します
                                $str = str_replace("_ex=128x128", "_ex=300x300", $item['mediumImageUrls'][0]['imageUrl']);
                                      
                                Item::updateOrCreate(
                                    ['itemCode' => $item['itemCode']],
                                    [
                                        'url' => $item['itemUrl'],
                                        'img' => $str,
                                        'price' => $item['itemPrice'],
                                        'genreId' => $item['genreId'],
                                        'shopName' => $item['shopName'],
                                        'shopUrl' => $item['shopUrl'],
                                        'itemName' => $item['itemName'],
                                        'caption' => $item['itemCaption'],
                                    ]
                                );
                            }
                        // }
                    }

                    
            }
        }



        }
                

           
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// カテゴリメモ
// ‐‐‐‐‐‐‐‐‐――――――――――――――――

// 必要な物
// 555086	トップス 1
// 555089	ボトムス 2
// 110729	ワンピース 3
// 555083	オールインワン・サロペット 4
// 555087	コート・ジャケット 5
// 100480	レディース靴 6
// 110933	レディースバッグ 7
// 110974	男女兼用バッグ 7
// 403732	レディース帽子 8
// 207204	眼鏡 8
// 110894	サングラス 8
// 560100	マフラー・スカーフ 8
// 403755	レディース手袋 8
// 403762	耳あて 8
// 207306	レディースベルト 8
// 100486	レディースジュエリー・アクセサリー 9

// ----------
// genreLevel: 1,
// genreName: レディースファッション,
// genreId: 100371
// genreLevel: 2, 0～210件 507～790件　283件(8P～100)
// ----------

// genreName: トップス,->Tops
// genreId: 555086

// genreName: ボトムス,->Bottoms
// genreId: 555089

// genreName: コート・ジャケット,->Outer
// genreId: 555087

// genreName: ワンピース,->One-piece
// genreId: 110729

// genreName: オールインワン・サロペット,->All-in-one
// genreId: 555083

// ----------
// genreLevel: 1,
// ----------
// genreName: 靴,->Shoes　※coca見ると216141というジャンルで出てくる
// genreId: 558885　210～212件　2件

// "genreName": "レディース靴",
//         "genreId": 100480
//         "genreName": "メンズ靴",
//         "genreId": 110983
//         "genreName": "靴ケア用品・アクセサリー",
//         "genreId": 216172
//         "genreName": "その他",
//         "genreId": 559278
        

// genreName: バッグ・小物・ブランド雑貨->Accessory
// genreId: 216131　212～267件　55件

// genreName: ジュエリー・アクセサリー,->Jewelry
// genreId: 216129 267～507件　240件
    // "genreLevel": 2,
    // "genreName": "レディースジュエリー・アクセサリー",
    // "genreId": 100486
    // shopCode：ete-store

// ‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐‐
    
        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        // public function store(Request $request)
        // {
   

        //         return redirect("item")->with("flash_message", "item added!");
        // }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
    //     public function show($id)
    //     {
    //         // $item = Item::findOrFail($id);
            
				// // ----------------------------------------------------
				// // -- QueryBuilder: SELECT [items]--
				// // ----------------------------------------------------
				// // $item = DB::table("items")　//stdClassエラー回避のためコメントアウトし下記1行追加
				// $item = Item::query()
				// ->select("*")->addSelect("items.id")->where("items.id",$id)->first();
    //         return view("item.show", compact("item"));
    //     }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
    //     public function edit($id)
    //     {
    //         $item = Item::findOrFail($id);
    
    //         return view("item.edit", compact("item"));
    //     }
    
    //     /**
    //      * Update the specified resource in storage.
    //      *
    //      * @param  int  $id
    //      * @param \Illuminate\Http\Request $request
    //      *
    //      * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    //      */
    //     public function update(Request $request, $id)
    //     {
    //         $this->validate($request, [
			 //// "itemCode" => "required|integer", //integer('itemCode')
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
            
    //         $item = Item::findOrFail($id);
    //         $item->update($requestData);
    
    //         return redirect("item")->with("flash_message", "item updated!");
    //     }
    
    //     /**
    //      * Remove the specified resource from storage.
    //      *
    //      * @param  int  $id
    //      *
    //      * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    //      */
    //     public function destroy($id)
    //     {
    //         Item::destroy($id);
    
    //         return redirect("item")->with("flash_message", "item deleted!");
    //     }
    }
    //=======================================================================
    
    