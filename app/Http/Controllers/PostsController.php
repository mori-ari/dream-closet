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
            $keyword = $request->get("search");
            $perPage = 500;
    
            if (!empty($keyword)) {
                
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [posts]--
				// ----------------------------------------------------
				$post = DB::table("posts")
				->orWhere("posts.uid", "LIKE", "%$keyword%")->orWhere("posts.title", "LIKE", "%$keyword%")->orWhere("posts.img1", "LIKE", "%$keyword%")->orWhere("posts.img2", "LIKE", "%$keyword%")->orWhere("posts.img3", "LIKE", "%$keyword%")->orWhere("posts.img4", "LIKE", "%$keyword%")->orWhere("posts.img5", "LIKE", "%$keyword%")->orWhere("posts.img6", "LIKE", "%$keyword%")->orWhere("posts.url1", "LIKE", "%$keyword%")->orWhere("posts.url2", "LIKE", "%$keyword%")->orWhere("posts.url3", "LIKE", "%$keyword%")->orWhere("posts.url4", "LIKE", "%$keyword%")->orWhere("posts.url5", "LIKE", "%$keyword%")->orWhere("posts.url6", "LIKE", "%$keyword%")->orWhere("posts.price1", "LIKE", "%$keyword%")->orWhere("posts.price2", "LIKE", "%$keyword%")->orWhere("posts.price3", "LIKE", "%$keyword%")->orWhere("posts.price4", "LIKE", "%$keyword%")->orWhere("posts.price5", "LIKE", "%$keyword%")->orWhere("posts.price6", "LIKE", "%$keyword%")->select("*")->addSelect("posts.id")->paginate($perPage);
            } else {
                    //$post = Post::paginate($perPage);
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [posts]--
				// ----------------------------------------------------
				$post = DB::table("posts")
				->select("*")->addSelect("posts.id")->paginate($perPage);              
            } 
            
            return view("post.index", compact("post"));
            

        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\View\View
         */
         
        public function create(Request $request)
        {
            
    // ------------------------------------            
    // item.indexから移植
    // ------------------------------------
      $keyword = $request->get("search");
            $perPage = 500;
    
            if (!empty($keyword)) {
                
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [items]--
				// ----------------------------------------------------
				$item = DB::table("items")
				->orWhere("items.itemCode", "LIKE", "%$keyword%")->orWhere("items.url", "LIKE", "%$keyword%")->orWhere("items.img", "LIKE", "%$keyword%")->orWhere("items.price", "LIKE", "%$keyword%")->orWhere("items.genreId", "LIKE", "%$keyword%")->orWhere("items.genreName", "LIKE", "%$keyword%")->orWhere("items.colorId", "LIKE", "%$keyword%")->orWhere("items.colorName", "LIKE", "%$keyword%")->orWhere("items.shopName", "LIKE", "%$keyword%")->orWhere("items.shopUrl", "LIKE", "%$keyword%")->orWhere("items.itemName", "LIKE", "%$keyword%")->orWhere("items.caption", "LIKE", "%$keyword%")->select("*")->addSelect("items.id")->paginate($perPage);
            } else {
                    $item = Item::paginate($perPage);
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [items]--
				// ----------------------------------------------------
				$item = DB::table("items")
				->select("*")->addSelect("items.id")->paginate($perPage);              
            }          


    
    
    
    
    // ------------------------------------            
    // 結果ページに変数渡す
    // ------------------------------------
    return view("post.create", compact("item"));
    

            
            // return view("post.create");
        }
    
    

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
				"genre1" => "nullable|integer", //integer('genre1')->nullable()
				"genre2" => "nullable|integer", //integer('genre2')->nullable()
				"genre3" => "nullable|integer", //integer('genre3')->nullable()
				"genre4" => "nullable|integer", //integer('genre4')->nullable()
				"genre5" => "nullable|integer", //integer('genre5')->nullable()
				"genre6" => "nullable|integer", //integer('genre6')->nullable()
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
            $img = Image::make('assets/img/template_4.png')->resize(1200, 628);


// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 商品画像のサイズを指定して、加工する画像の上に重ねる
// ‐‐‐‐‐‐‐‐‐――――――――――――――――            
            $width = 1;
            $height = 1;
            
            $image1 = Image::make($img1)->fit(265, 265);
            $image2 = Image::make($img2)->fit(194, 194);
            $image3 = Image::make($img3)->fit(278, 278);
            $image4 = Image::make($img4)->fit(216, 216);
            $image5 = Image::make($img5)->fit($width, $height);
            // $image6 = Image::make($img6)->fit($width, $height);

            $img->insert( $image1, 'top-left', 94, 64);
            $img->insert( $image2, 'top-left', 453, 13);
            $img->insert( $image3, 'top-left', 613, 289);
            $img->insert( $image4, 'top-left', 947, 226);
            // $img->insert( $image5, 'top-left', 900, 310);
            // $img->insert( $image6, 'top-left', 900, 10);

// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 投稿テキストを加工する画像の上に重ねる
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
            // 長めの文章を指定文字数で分割する
            $max_len = 11;
            $text = $title."なら".$who;
            $lines = self::mb_wordwrap($text, $max_len);

            // テキスト追加
            $img ->text($lines, 81, 476, function($font) {
                $font->file('assets/font/KosugiMaru-Regular.ttf'); // フォントファイル
                $font->size(40); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('middle');  // 縦の揃え方（top, middle, bottom）
                $font->color('#332118');  // 文字の色
            });
            
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// カテゴリを加工する画像の上に重ねる
// ‐‐‐‐‐‐‐‐‐――――――――――――――――

            $img ->text("All-in-one", 38, 20, function($font) {
                $font->file('assets/font/learningcurve_tt.ttf'); // フォントファイル
                $font->size(74); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#332118');  // 文字の色
            });
            
            $img ->text("All-in-one", 390, 216, function($font) {
                $font->file('assets/font/learningcurve_tt.ttf'); // フォントファイル
                $font->size(74); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#332118');  // 文字の色
            });
            
            $img ->text("All-in-one", 600, 550, function($font) {
                $font->file('assets/font/learningcurve_tt.ttf'); // フォントファイル
                $font->size(74); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#332118');  // 文字の色
            });
            
            $img ->text("All-in-one", 936, 445, function($font) {
                $font->file('assets/font/learningcurve_tt.ttf'); // フォントファイル
                $font->size(74); // 文字サイズ
                $font->align('left'); // 横の揃え方（left, center, right）
                $font->valign('top');  // 縦の揃え方（top, middle, bottom）
                $font->color('#332118');  // 文字の色
            });



// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 生成画像をstorage保存＋表示
// ‐‐‐‐‐‐‐‐‐――――――――――――――――

            // return $img->response();

            // 上記の２つの加工処理をした画像をファイル名を指定して保存する
            $img->save('storage/img/'.$uid.'.png'); 
            
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
// 投稿データをDB保存→結果ページ表示
// ‐‐‐‐‐‐‐‐‐――――――――――――――――
            // response保存
            Post::create($requestData);
                       
            // return $img->response();
            
            // S3保存する場合の参考コード
            // $disk = Storage::disk('s3');
            // $thumbnail_upload_path = 'upload/movie_thumbnail/'.Auth::id();
            // $disk->put($thumbnail_upload_path, file_get_contents($file_path), 'public');
            
            
            // return redirect("post/")->with("flash_message", "post added!");
            // return redirect('post')->with('success', '新しいプロフィールを登録しました');
            
            $resultpage = 'post/'.$uid;
            // dd($resultpage);
            

            return redirect($resultpage);
        }
        
        
        

    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
        // public function show($id)
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
    
    