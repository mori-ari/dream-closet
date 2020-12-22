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
            $perPage = 25;
    
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
        public function create()
        {
            
            // $uid = str_random(20);         

            
            return view("post.create");
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
            
            // dd($request);

            $this->validate($request, [
				"uid" => "nullable|max:20", //string('uid',20)->nullable()
				"title" => "nullable|max:255", //string('title',255)->nullable()
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

            ]);
            $requestData = $request->all();
            Post::create($requestData);
            
            $uid = $request->uid;
            $title = $request->title;
            $img1 = $request->img1;
            $img2 = $request->img2;
            $img3 = $request->img3;
            $img4 = $request->img4;
            $img5 = $request->img5;
            $img6 = $request->img6;
            $url1 = $request->url1;
            $url2 = $request->url2;
            $url3 = $request->url3;
            $url4 = $request->url4;
            $url5 = $request->url5;
            $url6 = $request->url6;
            $price1 = $request->price1;
            $price2 = $request->price2;
            $price3 = $request->price3;
            $price4 = $request->price4;
            $price5 = $request->price5;
            $price6 = $request->price6;
            

            

            // 加工する画像のパスを指定する
            $img = Image::make('assets/img/uid.png')->resize(1200, 628);
            // $img->resizeCanvas(1200, 628);
            // // 縮小
            // $width = 300;
            // $height = 300;
            // $img1->resize($width, null);
            // $img2->resize($width, null);
            // $img3->resize($width, null);
            // $img4->resize($width, null);
            // $img5->resize($width, null);
            // $img6->resize($width, null);
            // // トリミング
            // $img1->fit($width); //縦横比一緒
            // $img2->fit($width);//縦横比一緒
            // $img3->fit($width);//縦横比一緒
            // $img4->fit($width);//縦横比一緒
            // $img5->fit($width);//縦横比一緒
            // $img6->fit($width);//縦横比一緒
            // 加工する画像の上に指定した画像を重ねる。
            $img->insert( $img1, 'top-left', 0, 0);
            $img->insert( $img2, 'top-left', 0, 300);
            $img->insert( $img3, 'top-left', 300, 300);
            $img->insert( $img4, 'top-left', 600, 300);
            $img->insert( $img5, 'top-left', 900, 300);
            $img->insert( $img6, 'top-left', 900, 0);
            
            // $width = 300;
            // $height = 300;
            // $img1->resize($width, null);
            // $img2->resize($width, null);
            // $img3->resize($width, null);
            // $img4->resize($width, null);
            // $img5->resize($width, null);
            // $img6->resize($width, null);
            
            
            // $x = 40;
            // $y = 20;
            
            // $img->text($title, $x, $y, function($font){
            
            //     $font->file(storage_path('app/fonts/ipagp.ttf')); // フォントファイル
            //     $font->size(25);        // 文字サイズ
            //     $font->color('#000');   // 文字の色
            //     $font->align('left'); // 横の揃え方（left, center, right）
            //     $font->valign('top');   // 縦の揃え方（top, middle, bottom）

            // });
            
            $img ->text($title, 310, 10, function($font) {
            $font->file('font/KosugiMaru-Regular.ttf');
            $font->size(30);
            $font->align('left');
            $font->color('#000000');
            });
                        

            
            // 上記の２つの加工処理をした画像をファイル名を指定して保存する
            $img->save('storage/img/'. $uid.'.png'); 
                        return $img->response();
            
            
            // S3保存する場合の参考コード
            // $disk = Storage::disk('s3');
            // $thumbnail_upload_path = 'upload/movie_thumbnail/'.Auth::id();
            // $disk->put($thumbnail_upload_path, file_get_contents($file_path), 'public');
            
            
  
            
            
            


            // return redirect("post/show", compact("uid"))->with("flash_message", "post added!");
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
        public function edit($id)
        {
            $post = Post::findOrFail($id);
    
            return view("post.edit", compact("post"));
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
				"uid" => "nullable|max:20", //string('uid',20)->nullable()
				"title" => "nullable|max:255", //string('title',255)->nullable()
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

            ]);
            $requestData = $request->all();
            
            $post = Post::findOrFail($id);
            $post->update($requestData);
    
            return redirect("post")->with("flash_message", "post updated!");
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
            Post::destroy($id);
    
            return redirect("post")->with("flash_message", "post deleted!");
        }
    }
    //=======================================================================
    
    