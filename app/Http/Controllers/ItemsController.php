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
  
    // -------------------
    // 楽天1:apartbylowrys
    // -------------------
        public function apartbylowrys()
        {
        //楽天APIを扱うRakutenRws_Clientクラスのインスタンスを作成
        $client = new RakutenRws_Client();
        //定数化
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        //処理時間無制限に設定　https://www.freemen.jp/sys/php/679
        set_time_limit(0);
        ini_set('max_execution_time', 0);

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
            'apartbylowrys'
            // 'bcstock',
            // 'beams',
            // 'beams-outlet',
            // 'beautyandyouth',
            // 'coen',
            // 'converse',
            // 'ehyphen',
            // 'earth1999',
            // 'ete-store',
            // 'frayid',
            // 'freesmart',
            // 'globalwork',
            // 'heather',
            // 'shop-ined',
            // 'ingni-shop',
            // 'jeanasis',
            // 'jadorejunonline', 
            // 'jillbyjillstuart',
            // 'jillstuart',
            // 'jouete-store',
            // 'katespadenewyork',
            // 'kbf-rba',
            // 'kumikyoku',
            // 'lilybrown',
            // 'lowrysfarm',
            // 'mackintoshlondon',
            // 'mackintoshphilosophy',
            // 'majesticlegon',
            // 'milaowen',
            // 'milkfed',
            // 'mystywoman-shop',
            // 'nano-universe',
            // 'naturalbeautybasic',
            // 'nikoand',
            // 'odetteeodile',
            // 'pageboy-shop',
            // 'palgroupoutlet',
            // 'pinkyanddianne',
            // 'proportionbodydressing',
            // 'shop-raycassin',
            // 'ropepicnic',
            // 'rosebud',
            // 'sm2-can', 
            // 'samanthathavasa',
            // 'sanyoselect',
            // 'sheltter-webstore',
            // 'ships',
            // 'snidel',
            // 'thevirgnia',
            // 'unitedarrows',
            // 'greenlabelrelaxing',
            // 'unitedarrowsltdoutlet',
            // 'doors-rba',
            // 'ur-rba',
            // 'ur-items',
            // 'rosso-rba',
            // 'usonlinestore',
            // 'usagi-online',
            // 'vis-jun',
            // 'xgirl'
        ];
    
        foreach ($shopArrey as $key => $shopCode) {        
            foreach ($genreArrey as $key => $genreId) {
                $maxpage =1;
                for($i=1; $i<=$maxpage; $i++){
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => $shopCode,
                              'genreId' => $genreId,
                              'page' => $i,        
                              'hits' => 10,
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
        
// -------------------
// 楽天2 bcstock
// -------------------       
    public function bcstock()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'bcstock',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }
    
    
// -------------------
// 楽天3 beams
// -------------------       
    public function beams()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'beams',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }

// -------------------
// 楽天4 beams-outlet
// -------------------       
    public function beamsoutlet()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'beams-outlet',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }

// -------------------
// 楽天5 beautyandyouth
// -------------------       
    public function beautyandyouth()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'beautyandyouth',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }

// -------------------
// 楽天6 coen
// -------------------       
    public function coen()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'coen',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }

// -------------------
// 楽天7 converse
// -------------------       
    public function converse()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'converse',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }

// -------------------
// 楽天8 ehyphen
// -------------------       
    public function ehyphen()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'ehyphen',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }
// -------------------
// 楽天9 earth1999
// -------------------       
    public function earth1999()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'earth1999',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }
// -------------------
// 楽天10 ete-store
// -------------------       
    public function etestore()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'ete-store',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  



// -------------------
// 楽天11　frayid
// -------------------       
    public function frayid()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'frayid',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    


// -------------------
// 楽天12  freesmart
// -------------------       
    public function freesmart()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'freesmart',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  

// -------------------
// 楽天13  globalwork
// -------------------       
    public function globalwork()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'globalwork',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  




// -------------------
// 楽天14  heather
// -------------------       
    public function heather()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'heather',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    


// -------------------
// 楽天15  shopined
// -------------------       
    public function shopined()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'shop-ined',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  


// -------------------
// 楽天16  ingnishop
// -------------------       
    public function ingnishop()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'ingni-shop',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  


 
// -------------------
// 楽天17 jeanasis
// -------------------       
    public function jeanasis()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'jeanasis',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  




// -------------------
// 楽天18  jadorejunonline
// -------------------       
    public function jadorejunonline()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'jadorejunonline',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  



// -------------------
// 楽天19  jillbyjillstuart
// -------------------       
    public function jillbyjillstuart()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'jillbyjillstuart',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  

// -------------------
// 楽天20  jillstuart
// -------------------       
    public function jillstuart()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'jillstuart',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  

    


// -------------------
// 楽天21  jouetestore
// -------------------       
    public function jouetestore()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'jouete-store',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  




   
// -------------------
// 楽天22  katespadenewyork
// -------------------       
    public function katespadenewyork()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'katespadenewyork',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    } 





// -------------------
// 楽天23  kbfrba
// -------------------       
    public function kbfrba()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'kbf-rba',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  



// -------------------
// 楽天24 kumikyoku
// -------------------       
    public function kumikyoku()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'kumikyoku',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  





// -------------------
// 楽天25  lilybrown
// -------------------       
    public function lilybrown()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'lilybrown',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  




// -------------------
// 楽天26  lowrysfarm
// -------------------       
    public function lowrysfarm()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'lowrysfarm',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  



// -------------------
// 楽天27  mackintoshlondon
// -------------------       
    public function mackintoshlondon()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'mackintoshlondon',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  





// -------------------
// 楽天28 mackintoshphilosophy
// -------------------       
    public function mackintoshphilosophy()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'mackintoshphilosophy',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
  


// -------------------
// 楽天29  majesticlegon
// -------------------       
    public function majesticlegon()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'majesticlegon',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  



// -------------------
// 楽天30 milaowen
// -------------------       
    public function milaowen()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'milaowen',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    
            


// -------------------
// 楽天31  milkfed
// -------------------       
    public function milkfed()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'milkfed',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    } 
    
            
// -------------------
// 楽天32  mystywoman-shop
// -------------------       
    public function mystywomanshop()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'mystywoman-shop',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  

// -------------------
// 楽天33  nano-universe
// -------------------       
    public function nanouniverse()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'nano-universe',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    } 
    


    // -------------------
// 楽天34  naturalbeautybasi
// -------------------       
    public function naturalbeautybasic()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'naturalbeautybasic',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    
        

// -------------------
// 楽天35  nikoand
// -------------------       
    public function nikoand()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'nikoand',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    } 
    
    
        
            
    // -------------------
// 楽天36  odetteeodile
// -------------------       
    public function odetteeodile()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'odetteeodile',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    
    
    // -------------------
// 楽天37  pageboy-shop
// -------------------       
    public function pageboyshop()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'pageboy-shop',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    
   
           

    // -------------------
// 楽天38  palgroupoutlet
// -------------------       
    public function palgroupoutlet()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'palgroupoutlet',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    

    // -------------------
// 楽天39  pinkyanddianne
// -------------------       
    public function pinkyanddianne()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'pinkyanddianne',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    
    
    
            
// -------------------
// 楽天40  proportionbodydressing
// -------------------       
    public function proportionbodydressing()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'proportionbodydressing',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    
    
    
           
            
// -------------------
// 楽天41  shop-raycassin
// -------------------       
    public function shopraycassin()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'shop-raycassin',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
   
            
   
    // -------------------
// 楽天42  ropepicnic
// -------------------       
    public function ropepicnic()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'ropepicnic',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  

 
    // -------------------
// 楽天43  rosebud
// -------------------       
    public function rosebud()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'rosebud',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
            

    // -------------------
// 楽天44  sm2-can
// -------------------       
    public function sm2can()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'sm2-can',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  

            
    // -------------------
// 楽天45  samanthathavasa
// -------------------       
    public function samanthathavasa()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'samanthathavasa',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    
    // -------------------
// 楽天46  sanyoselect
// -------------------       
    public function sanyoselect()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'sanyoselect',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  


    // -------------------
// 楽天47  sheltter-webstore
// -------------------       
    public function sheltterwebstore()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'sheltter-webstore',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
        
            
    // -------------------
// 楽天48  ships
// -------------------       
    public function ships()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'ships',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  

            
    // -------------------
// 楽天49  snidel
// -------------------       
    public function snidel()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'snidel',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }  
    
     
    // -------------------
// 楽天50  thevirgnia
// -------------------       
    public function thevirgnia()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'thevirgnia',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     


    // -------------------
// 楽天51  unitedarrows
// -------------------       
    public function unitedarrows()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'unitedarrows',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     
           
            
            
    // -------------------
// 楽天52  greenlabelrelaxing
// -------------------       
    public function greenlabelrelaxing()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'greenlabelrelaxing',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     

            
    // -------------------
// 楽天53  unitedarrowsltdoutlet
// -------------------       
    public function unitedarrowsltdoutlet()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'unitedarrowsltdoutlet',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     

          
    // -------------------
// 楽天54  doors-rba
// -------------------       
    public function doorsrba()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'doors-rba',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     

            
    // -------------------
// 楽天55 ur-rba
// -------------------       
    public function urrba()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'ur-rba',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     

        
    // -------------------
// 楽天56  ur-items
// -------------------       
    public function uritems()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'ur-items',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     
    
            
    // -------------------
// 楽天57  rosso-rba
// -------------------       
    public function rossorba()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'rosso-rba',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     

     
    // -------------------
// 楽天58  usonlinestore
// -------------------       
    public function usonlinestore()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'usonlinestore',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     
     
            
    // -------------------
// 楽天59 usagi-online
// -------------------       
    public function usagionline()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'usagi-online',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     

            
           
    // -------------------
// 楽天60  vis-jun
// -------------------       
    public function visjun()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'vis-jun',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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
                        }
            }
    }     

    // -------------------
// 楽天61  xgirl
// -------------------       
    public function xgirl()
    {
        $client = new RakutenRws_Client();
        define("RAKUTEN_APPLICATION_ID", config('app.rakuten_id'));
        define("RAKUTEN_APPLICATION_SEACRET", config('app.rakuten_key'));
        define("RAKUTEN_AFFILIATE_ID", config('app.rakuten_aff'));
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);
        $client->setAffiliateId(RAKUTEN_AFFILIATE_ID);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
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
            foreach ($genreArrey as $key => $genreId) {
                            $response[] = $client->execute('IchibaItemSearch', array(
                              'shopCode' => 'xgirl',
                              'genreId' => $genreId,
                              'page' => 1,        
                              'hits' => 30,
                              'imageFlag' => 1,
                            ));
                 foreach ($response as $key => $val) {
                            foreach ($val as $item){
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


}
  