<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Validate;
use DB;
use App\Post;
use App\Item;
use Intervention\Image\Facades\Image;



    
    //=======================================================================
    class PostsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\View\View
         */
        public function index(Request $request)
        {
            // orderBy('id', 'desc')->を追加して降順表示した
            $perPage = 8;
            $post = DB::table("posts")
				->select("*")->addSelect("posts.id")->orderBy('id', 'desc')->paginate($perPage); 
			return view("post.index",compact("post"));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\View\View
         */
         
        public function create(Request $request)
        {
            
        // inRandomOrder()->ランダム表示　orderBy('updated_at', 'desc')更新日降順 
            $perPage = 30;
            // $items = DB::table("items")->select("*")->addSelect("items.id")->orderBy('updated_at', 'desc')->simplePaginate($perPage);
			$tops= DB::table("items")
    			->where('genreId', '=','303656') 
    			->orWhere('genreId', '=','566018')
    			->orWhere('genreId', '=','206471')
    			->orWhere('genreId', '=','409352')
    			->orWhere('genreId', '=','303662')
    			->orWhere('genreId', '=','303655')
    			->orWhere('genreId', '=','403871')
    			->orWhere('genreId', '=','403890')
    			->orWhere('genreId', '=','303699')
    			->orWhere('genreId', '=','566028')
    			->orWhere('genreId', '=','566029')
    			->orWhere('genreId', '=','566030')
    			->orWhere('genreId', '=','200343')
    			->orWhere('genreId', '=','502556')
    			->orWhere('genreId', '=','403923')
    			->orWhere('genreId', '=','112719')
    			->orWhere('genreId', '=','553029')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'tops');
			$bottoms= DB::table("items")
    			->where('genreId', '=','110734')
    			->orWhere('genreId', '=','303587')
    			->orWhere('genreId', '=','206440')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'bottoms');
    			$request->session()->put('key', 'value');
			$onepiece= DB::table("items")
    			->where('genreId', '=','110729')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'onepiece');
			$allinone= DB::table("items")
    			->where('genreId', '=','555083')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'allinone');
			$outer= DB::table("items")
    			->where('genreId', '=','555087')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'outer');
			$shoes= DB::table("items")
    			->where('genreId', '=','206900')
    			->orWhere('genreId', '=','558903')
    			->orWhere('genreId', '=','206906')
    			->orWhere('genreId', '=','216141')
    			->orWhere('genreId', '=','216148')
    			->orWhere('genreId', '=','403979')
    			->orWhere('genreId', '=','558908')
    			->orWhere('genreId', '=','304095')
    			->orWhere('genreId', '=','564562')
    			->orWhere('genreId', '=','216160')
    			->orWhere('genreId', '=','564581')
    			->orWhere('genreId', '=','563969')
    			->orWhere('genreId', '=','403975')
    			->orWhere('genreId', '=','403986')
    			->orWhere('genreId', '=','112758')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'shoes');
			$bag= DB::table("items")
    			->where('genreId', '=','110934')
    			->orWhere('genreId', '=','110966')
    			->orWhere('genreId', '=','110942')
    			->orWhere('genreId', '=','303257')
    			->orWhere('genreId', '=','110950')
    			->orWhere('genreId', '=','506663')
    			->orWhere('genreId', '=','210811')
    			->orWhere('genreId', '=','303261')
    			->orWhere('genreId', '=','403822')
    			->orWhere('genreId', '=','403605')
    			->orWhere('genreId', '=','509179')
    			->orWhere('genreId', '=','506673')
    			->orWhere('genreId', '=','303274')
    			->orWhere('genreId', '=','303273')
    			->orWhere('genreId', '=','566333')
    			->orWhere('genreId', '=','112750')
    			->orWhere('genreId', '=','110976')
    			->orWhere('genreId', '=','408790')
    			->orWhere('genreId', '=','568467')
    			->orWhere('genreId', '=','408791')
    			->orWhere('genreId', '=','408789')
    			->orWhere('genreId', '=','206858')
    			->orWhere('genreId', '=','112756')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'bag');
			$accessory= DB::table("items")
    			->where('genreId', '=','403736')
    			->orWhere('genreId', '=','403735')
    			->orWhere('genreId', '=','403742')
    			->orWhere('genreId', '=','403743')
    			->orWhere('genreId', '=','403733')
    			->orWhere('genreId', '=','403737')
    			->orWhere('genreId', '=','403744')
    			->orWhere('genreId', '=','567475')
    			->orWhere('genreId', '=','567476')
    			->orWhere('genreId', '=','110746')
    			->orWhere('genreId', '=','110894')
    			->orWhere('genreId', '=','207314')
    			->orWhere('genreId', '=','207328')
    			->orWhere('genreId', '=','408914')
    			->orWhere('genreId', '=','110718')
    			->orWhere('genreId', '=','566741')
    			->orWhere('genreId', '=','564008')
    			->orWhere('genreId', '=','564010')
    			->orWhere('genreId', '=','568213')
    			->orWhere('genreId', '=','563321')
    			->orWhere('genreId', '=','403755')
    			->orWhere('genreId', '=','403762')
    			->orWhere('genreId', '=','207306')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'accessory');
			$jewelry= DB::table("items")
    			->where('genreId', '=','100487')
    			->orWhere('genreId', '=','564629')
    			->orWhere('genreId', '=','111029')
    			->orWhere('genreId', '=','100500')
    			->orWhere('genreId', '=','407236')
    			->orWhere('genreId', '=','206999')
    			->orWhere('genreId', '=','111048')
    			->orWhere('genreId', '=','111061')
    			->orWhere('genreId', '=','567210')
    			->orWhere('genreId', '=','407286')
    			->orWhere('genreId', '=','113074')
    			->orWhere('genreId', '=','407291')
    			->orWhere('genreId', '=','113066')
    			->orWhere('genreId', '=','508555')
    			->orWhere('genreId', '=','407301')
    			->orWhere('genreId', '=','207029')
    			->orWhere('genreId', '=','207050')
    			->orWhere('genreId', '=','407309')
    			->orWhere('genreId', '=','407312')
    			->orWhere('genreId', '=','564630')
    			->orWhere('genreId', '=','564631')
    			->orWhere('genreId', '=','101824')
    			->orderBy('updated_at', 'desc')->simplePaginate($perPage, ["*"], 'jewelry');
    			
			return view("post.create",compact("tops","bottoms","onepiece","allinone","outer","shoes","bag","accessory","jewelry"));

        }
    
    
// トップス
// 303656	Tシャツ・カットソー
// 566018	タンクトップ
// 206471	シャツ・ブラウス
// 409352	ポロシャツ
// 303662	キャミソール
// 303655	ベアトップ・チューブトップ
// 403871	カーディガン・ボレロ
// 403890	ベスト・ジレ
// 303699	アンサンブル
// 566028	セーター
// 566029	ニットパーカー
// 566030	ニットキャミソール
// 200343	その他
// 502556	パーカー
// 403923	スウェット・トレーナー
// 112719	その他
// 553029	チュニック
// ボトムス
// 110734	スカート
// 303587	キュロット
// 206440	パンツ
// バッグ
// 110934	ハンドバッグ
// 110966	バックパック・リュック
// 110942	ショルダーバッグ・メッセンジャーバッグ
// 303257	ボディバッグ・ウエストポーチ
// 110950	トートバッグ
// 506663	クラッチバッグ・セカンドバッグ
// 210811	ボストンバッグ
// 303261	アクセサリーポーチ
// 403822	化粧ポーチ
// 403605	ブラックフォーマルバッグ
// 509179	かごバッグ
// 506673	パーティーバッグ
// 303274	マザーズバッグ
// 303273	ビジネスバッグ・ブリーフケース
// 566333	2way・3wayバッグ
// 112750	その他
// 110976	バックパック・リュック
// 408790	ショルダーバッグ・メッセンジャーバッグ
// 568467	サコッシュ
// 408791	ボディバッグ・ウエストポーチ
// 408789	トートバッグ
// 206858	ボストンバッグ
// 112756	その他
// 小物
// 403736	キャップ
// 403735	ハット
// 403742	サンバイザー
// 403743	麦わら帽子
// 403733	ニット帽
// 403737	ハンチング・キャスケット
// 403744	ベレー帽
// 567475	ターバンキャップ
// 567476	パイロットキャップ
// 110746	その他
// 207204	眼鏡
// 110894	サングラス
// 207314	レディースマフラー・ストール
// 207328	レディーススカーフ
// 408914	メンズマフラー・ストール
// 110718	メンズスカーフ
// 566741	ツイリースカーフ
// 564008	ネックウォーマー・スヌード
// 564010	ティペット
// 568213	スカーフリング
// 563321	その他
// 403755	レディース手袋
// 403762	耳あて
// 207306	レディースベルト
// 靴
// 206900	ブーツ
// 558903	ブーティ
// 206906	スニーカー
// 216141	パンプス
// 216148	カッター
// 403979	レインシューズ・長靴
// 558908	バレエシューズ
// 216153	サンダル
// 304095	ミュール
// 564562	スリッポン
// 216160	ローファー
// 564581	モカシン
// 563969	スノーシューズ
// 403975	ウォーキングシューズ
// 403986	福袋
// 112758	その他
// アクセサリー
// 100487	指輪・リング
// 564629	ピンキーリング
// 111029	ネックレス・ペンダント
// 100500	ネックレスチェーン
// 407236	ペンダントトップ
// 206999	チョーカー
// 111048	イヤリング
// 111061	ピアス
// 567210	ピアスキャッチ
// 407286	コサージュ
// 113074	ブローチ
// 407291	カメオ
// 113066	ブレスレット
// 508555	バングル
// 407301	アンクレット
// 207029	ラリエット
// 207050	ヘアアクセサリー
// 407309	トゥリング
// 407312	チャーム
// 564630	インディアンジュエリー
// 564631	ハワイアンジュエリー
// 101824	その他
    
    

    // 文字を指定した文字数で分割・改行する
        public function mb_wordwrap($str, $width, $break=PHP_EOL )
            {
                $c = mb_strlen($str);
                $arr = [];
                for ($i=0; $i<=$c; $i+=$width) {
                    $arr[] = mb_substr($str, $i, $width);
                }
                return implode($break, $arr);
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
            $uid = str_random(20);
            $request->merge(array ('uid' => $uid));
            $this->validate($request, [
				"uid" => "nullable|max:20", //string('uid',20)->nullable()
				"title" => "nullable|max:255", //string('title',255)->nullable()
				"who" => "nullable|max:255", //string('who',255)->nullable()
				"img1" => "nullable", //text('img1')->nullable()
				"img2" => "nullable", //text('img2')->nullable()
				"img3" => "nullable", //text('img3')->nullable()
				"img4" => "nullable", //text('img4')->nullable()
				"img5" => "nullable", //text('img5')->nullable()
				"img6" => "nullable", //text('img6')->nullable()
				"url1" => "nullable", //text('url1')->nullable()
				"url2" => "nullable", //text('url2')->nullable()
				"url3" => "nullable", //text('url3')->nullable()
				"url4" => "nullable", //text('url4')->nullable()
				"url5" => "nullable", //text('url5')->nullable()
				"url6" => "nullable", //text('url6')->nullable()
				"price1" => "nullable|integer", //integer('price1')->nullable()
				"price2" => "nullable|integer", //integer('price2')->nullable()
				"price3" => "nullable|integer", //integer('price3')->nullable()
				"price4" => "nullable|integer", //integer('price4')->nullable()
				"price5" => "nullable|integer", //integer('price5')->nullable()
				"price6" => "nullable|integer", //integer('price6')->nullable()
				"genre1" => "nullable", //string('genre1')->nullable()
				"genre2" => "nullable", //string('genre2')->nullable()
				"genre3" => "nullable", //string('genre3')->nullable()
				"genre4" => "nullable", //string('genre4')->nullable()
				"genre5" => "nullable", //string('genre5')->nullable()
				"genre6" => "nullable", //string('genre6')->nullable()
            ]);

            $requestData = $request->all();
            
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 変数リスト
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
            $id = $request->id;
            $uid = $request->uid;
            $title = $request->title;
            $who = $request->who;
            $img1 = $request->img1;
            $img2 = $request->img2;
            $img3 = $request->img3;
            $img4 = $request->img4;
            $img5 = $request->img5;
            // $img6 = $request->img6;
            $url1 = $request->url1;
            $url2 = $request->url2;
            $url3 = $request->url3;
            $url4 = $request->url4;
            $url5 = $request->url5;
            // $url6 = $request->url6;
            $price1 = $request->price1;
            $price2 = $request->price2;
            $price3 = $request->price3;
            $price4 = $request->price4;
            $price5 = $request->price5;
            // $price6 = $request->price6;
            $genre1 = $request->genre1;
            $genre2 = $request->genre2;
            $genre3 = $request->genre3;
            $genre4 = $request->genre4;
            $genre5 = $request->genre5;
            // $genre6 = $request->genre6;
            
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 加工する画像のパスを指定する
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
            $img = Image::make('assets/img/template_4.png')->resize(750, 393);

// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 商品画像のサイズを指定して、加工する画像の上に重ねる
// ‐‐‐‐‐‐‐‐‐――――――――――――――――            
            $width = 1;
            $height = 1;
            
            $image1 = Image::make($img1)->fit(163, 163);
            $image2 = Image::make($img2)->fit(122, 122);
            $image3 = Image::make($img3)->fit(172, 172);
            $image4 = Image::make($img4)->fit(136, 136);
            // $image5 = Image::make($img5)->fit($width, $height);
            // $image6 = Image::make($img6)->fit($width, $height);

            $img->insert( $image1, 'top-left', 59, 43);
            $img->insert( $image2, 'top-left', 283, 8);
            $img->insert( $image3, 'top-left', 384, 181);
            $img->insert( $image4, 'top-left', 591, 141);
            // $img->insert( $image5, 'top-left', 900, 310);
            // $img->insert( $image6, 'top-left', 900, 10);

// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 投稿テキストを加工する画像の上に重ねる
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
            // 長めの文章を指定文字数で分割する
            $max_len = 12;
            $lines = self::mb_wordwrap($title, $max_len);

            // 妄想コーデテーマ追加
            $img ->text($lines, 50, 311, function($font) {
                $font->file('assets/font/KosugiMaru-Regular.ttf'); // フォントファイル
                $font->size(22); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('middle');  // 縦の揃え方（top, middle, bottom）
                $font->color('#332118');  // 文cd 字の色
            });
            
            // ニックネーム追加
            $img ->text($who, 162, 235, function($font) {
                $font->file('assets/font/KosugiMaru-Regular.ttf'); // フォントファイル
                $font->size(17); // 文字サイズ
                $font->align('center'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#fff');  // 文字の色
            });
            
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// カテゴリを加工する画像の上に重ねる
// ‐‐‐‐‐‐‐‐‐――――――――――――――――

            $img ->text($genre1, 24, 7, function($font) {
                $font->file('assets/font/BadScript-Regular.ttf'); // フォントファイル
                $font->size(45); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#7E6558');  // 文字の色
            });
            
            $img ->text($genre2, 244, 135, function($font) {
                $font->file('assets/font/BadScript-Regular.ttf'); // フォントファイル
                $font->size(37); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#7E6558');  // 文字の色
            });
            
            $img ->text($genre3, 375, 340, function($font) {
                $font->file('assets/font/BadScript-Regular.ttf'); // フォントファイル
                $font->size(35); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#7E6558');  // 文字の色
            });
            
            $img ->text($genre4, 585, 278, function($font) {
                $font->file('assets/font/BadScript-Regular.ttf'); // フォントファイル
                $font->size(34); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#7E6558');  // 文字の色
            });




// // ‐‐‐‐‐‐‐‐‐――――――――――――――――
// // 加工する画像のパスを指定する
// // ‐‐‐‐‐‐‐‐‐――――――――――――――――
//             $img = Image::make('assets/img/template_4.png')->resize(1200, 628);

// // ‐‐‐‐‐‐‐‐‐――――――――――――――――
// // 商品画像のサイズを指定して、加工する画像の上に重ねる
// // ‐‐‐‐‐‐‐‐‐――――――――――――――――            
//             $width = 1;
//             $height = 1;
            
//             $image1 = Image::make($img1)->fit(265, 265);
//             $image2 = Image::make($img2)->fit(194, 194);
//             $image3 = Image::make($img3)->fit(278, 278);
//             $image4 = Image::make($img4)->fit(216, 216);
//             // $image5 = Image::make($img5)->fit($width, $height);
//             // $image6 = Image::make($img6)->fit($width, $height);

//             $img->insert( $image1, 'top-left', 94, 64);
//             $img->insert( $image2, 'top-left', 453, 13);
//             $img->insert( $image3, 'top-left', 613, 289);
//             $img->insert( $image4, 'top-left', 947, 226);
//             // $img->insert( $image5, 'top-left', 900, 310);
//             // $img->insert( $image6, 'top-left', 900, 10);

// // ‐‐‐‐‐‐‐‐‐――――――――――――――――
// // 投稿テキストを加工する画像の上に重ねる
// // ‐‐‐‐‐‐‐‐‐――――――――――――――――
//             // 長めの文章を指定文字数で分割する
//             $max_len = 11;
//             $lines = self::mb_wordwrap($title, $max_len);

//             // 妄想コーデテーマ追加
//             $img ->text($lines, 81, 498, function($font) {
//                 $font->file('assets/font/KosugiMaru-Regular.ttf'); // フォントファイル
//                 $font->size(38); // 文字サイズ
//                 $font->align('left'); // 横の揃え方（left, center, right）
//                 $font->valign('middle');  // 縦の揃え方（top, middle, bottom）
//                 $font->color('#332118');  // 文cd 字の色
//             });
            
//             // ニックネーム追加
//             $img ->text($who, 260, 377, function($font) {
//                 $font->file('assets/font/KosugiMaru-Regular.ttf'); // フォントファイル
//                 $font->size(26); // 文字サイズ
//                 $font->align('center'); // 横の揃え方（left, center, right）
//                 $font->valign('top');  // 縦の揃え方（top, middle, bottom）
//                 $font->color('#fff');  // 文字の色
//             });
            
// // ‐‐‐‐‐‐‐‐‐――――――――――――――――
// // カテゴリを加工する画像の上に重ねる
// // ‐‐‐‐‐‐‐‐‐――――――――――――――――

//             $img ->text($genre1, 38, 14, function($font) {
//                 $font->file('assets/font/BadScript-Regular.ttf'); // フォントファイル
//                 $font->size(70); // 文字サイズ
//                 $font->align('left'); // 横の揃え方（left, center, right）
//                 $font->valign('top');  // 縦の揃え方（top, middle, bottom）
//                 $font->color('#7E6558');  // 文字の色
//             });
            
//             $img ->text($genre2, 390, 216, function($font) {
//                 $font->file('assets/font/BadScript-Regular.ttf'); // フォントファイル
//                 $font->size(60); // 文字サイズ
//                 $font->align('left'); // 横の揃え方（left, center, right）
//                 $font->valign('top');  // 縦の揃え方（top, middle, bottom）
//                 $font->color('#7E6558');  // 文字の色
//             });
            
//             $img ->text($genre3, 600, 550, function($font) {
//                 $font->file('assets/font/BadScript-Regular.ttf'); // フォントファイル
//                 $font->size(62); // 文字サイズ
//                 $font->align('left'); // 横の揃え方（left, center, right）
//                 $font->valign('top');  // 縦の揃え方（top, middle, bottom）
//                 $font->color('#7E6558');  // 文字の色
//             });
            
//             $img ->text($genre4, 936, 445, function($font) {
//                 $font->file('assets/font/BadScript-Regular.ttf'); // フォントファイル
//                 $font->size(56); // 文字サイズ
//                 $font->align('left'); // 横の揃え方（left, center, right）
//                 $font->valign('top');  // 縦の揃え方（top, middle, bottom）
//                 $font->color('#7E6558');  // 文字の色
//             });



// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 生成画像をstorage保存＋表示
// ‐‐‐‐‐‐‐‐‐――――――――――――――――

            // 上記の２つの加工処理をした画像をファイル名を指定して保存する
            $img->save('storage/img/'.$uid.'.png'); 
            
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 投稿データをDB保存→結果ページ表示
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
            // response保存
            Post::create($requestData);
            // return $img->response();
            $resultpage = 'post/'.$uid;
            return redirect($resultpage);
        }
        
        
        

    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
        public function show($uid)
        {
            // $post = Post::findOrFail($id);
            

            
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [posts]--
				// ----------------------------------------------------
				$post = DB::table("posts")
				->select("*")->addSelect("posts.uid")->where("posts.uid",$uid)->first();
				
				
				
				
            return view("post.show", compact("post"));
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
        // public function edit($id)
        // {
        //     $post = Post::findOrFail($id);
    
        //     return view("post.edit", compact("post"));
        // }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  int  $id
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
    //     public function update(Request $request, $id)
    //     {
    //         $this->validate($request, [
				// "uid" => "nullable|max:20", //string('uid',20)->nullable()
				// "title" => "nullable|max:255", //string('title',255)->nullable()
				// "img1" => "nullable", //text('img1')->nullable()
				// "img2" => "nullable", //text('img2')->nullable()
				// "img3" => "nullable", //text('img3')->nullable()
				// "img4" => "nullable", //text('img4')->nullable()
				// "img5" => "nullable", //text('img5')->nullable()
				// "img6" => "nullable", //text('img6')->nullable()
				// "url1" => "nullable", //text('url1')->nullable()
				// "url2" => "nullable", //text('url2')->nullable()
				// "url3" => "nullable", //text('url3')->nullable()
				// "url4" => "nullable", //text('url4')->nullable()
				// "url5" => "nullable", //text('url5')->nullable()
				// "url6" => "nullable", //text('url6')->nullable()
				// "price1" => "nullable|integer", //integer('price1')->nullable()
				// "price2" => "nullable|integer", //integer('price2')->nullable()
				// "price3" => "nullable|integer", //integer('price3')->nullable()
				// "price4" => "nullable|integer", //integer('price4')->nullable()
				// "price5" => "nullable|integer", //integer('price5')->nullable()
				// "price6" => "nullable|integer", //integer('price6')->nullable()

    //         ]);
    //         $requestData = $request->all();
            
    //         $post = Post::findOrFail($id);
    //         $post->update($requestData);
    
    //         return redirect("post")->with("flash_message", "post updated!");
    //     }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        // public function destroy($id)
        // {
        //     Post::destroy($id);
    
        //     return redirect("post")->with("flash_message", "post deleted!");
        // }
    }
    //=======================================================================
    
    