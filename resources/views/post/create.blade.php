@extends("layouts.app")
@section('title', '妄想コーデを作成する | #私の妄想コーデ')
@section('description', '妄想コーデを作成してTwitterに投稿しませんか？')
@section('url', 'post/')
@section('ogimage', 'ogp')
        @section("content")
        
<main>
<h1>妄想コーデを作成する</h1>       

    <div class="form">

        <form action="/post/store" method="POST">
           {{ csrf_field() }}
        <div class="label">1．ニックネームを入力<span class="required">必須</span><span class="count">(<span class="name-count">0</span>字/10字)</span></div>

            <div class="cp_iptxt">
            	<label class="ef">
            		<input type="text" placeholder="ニックネーム" id="who" name="who" maxlength="10" required>
            	</label>
                    <span class="attention">※結果画面に表示します</span>
            </div>


        <div class="label">2．どんな妄想コーデを作る？<span class="required">必須</span><span class="count">(<span class="show-count">0</span>字/42字)</span></div>
            <div class="cp_iptxt">
            	<label class="ef">
            	<textarea placeholder="例：7kg痩せたら着たい服／好きなキャラに着せたい妄想コーデ" id="title" name="title" maxlength="42" required></textarea>
            	</label>
            </div>
            
        <div class="label">3．商品画像を選択する<span class="required">必須</span><!--<span class="count">(4～5点)</span>--></div>

        <div id="select">
            <div class="default-wrapper">
            <div class="default-box">
                <img src="{{ asset('assets/img/default.png') }}" id="item1" class="default" alt="">
            </div>
            <div class="default-box">
            <img src="{{ asset('assets/img/default.png') }}" id="item2" class="default" alt="">
            </div>
            <div class="default-box">
            <img src="{{ asset('assets/img/default.png') }}" id="item3" class="default" alt="">
            </div>
            <div class="default-box">
            <img src="{{ asset('assets/img/default.png') }}" id="item4" class="default" alt="">
            </div>
            <!--<div class="default-box">-->
            <!--<img src="{{ asset('assets/img/default.png') }}" id="item5" class="default" alt="">-->
            <!--</div>-->
            </div>
            <div class="attention">※選択済み画像を押すと選択解除できます</div>
       
            <!-- 商品画像 -->
            <input id="img1" type="hidden" name="img1" value="{{ asset('assets/img/default.png') }}">
            <input id="img2" type="hidden" name="img2" value="{{ asset('assets/img/default.png') }}">
            <input id="img3" type="hidden" name="img3" value="{{ asset('assets/img/default.png') }}">
            <input id="img4" type="hidden" name="img4" value="{{ asset('assets/img/default.png') }}">
            <!--<input id="img5" type="hidden" name="img5" value="{{ asset('assets/img/default.png') }}">-->
    
            <!-- 商品URL -->
            <input id="url1" type="hidden" name="url1" value="">
            <input id="url2" type="hidden" name="url2" value="">
            <input id="url3" type="hidden" name="url3" value="">
            <input id="url4" type="hidden" name="url4" value="">
            <!--<input id="url5" type="hidden" name="url5"value="">-->
            
            <!-- 商品価格 -->
            <input id="price1" type="hidden" name="price1" value="">
            <input id="price2" type="hidden" name="price2" value="">
            <input id="price3" type="hidden" name="price3" value="">
            <input id="price4" type="hidden" name="price4" value="">
            <!--<input id="price5" type="hidden" name="price5" value="">-->
    
            <!--ジャンル -->
            <input id="genre1" type="hidden" name="genre1" value="">
            <input id="genre2" type="hidden" name="genre2" value="">
            <input id="genre3" type="hidden" name="genre3" value="">
            <input id="genre4" type="hidden" name="genre4" value="">
            <!--<input id="genre5" type="hidden" name="genre5" value="">-->
    
            <div class="bt-box"><input class="bt" id="submit" type="hidden" value="アイテム決定"></div>
        </div>
        </form>
    </div>
     


      
      
  <div class="container" id="tab-head">
        <!-- メニュー部分 -->
        <div id="tab" class="swiper-container tab-menu">
          <div class="swiper-wrapper">
            <div class="swiper-slide">トップス</div>
            <div class="swiper-slide">ボトムス</div>
            <div class="swiper-slide">ワンピース</div>
            <div class="swiper-slide">オールインワン</div>
            <div class="swiper-slide">アウター</div>
            <div class="swiper-slide">靴</div>
            <div class="swiper-slide">バッグ</div>
            <div class="swiper-slide">小物</div>
            <div class="swiper-slide">アクセサリー</div>
          </div>
        </div>
        <!-- コンテンツ部分 -->
        <div class="swiper-container tab-contents">
          <div class="swiper-wrapper">


            <!--トップス-->
            <div class="swiper-slide">
                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".tops"-->
                <!--  }'>-->
                    @foreach($tops as $item)
                        <div class="item tops">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="Tops"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
            {{ $tops->fragment('tab-head')->links() }}
            </div>

            <!--ボトムス-->
            <div class="swiper-slide">
                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".bottoms"-->
                <!--  }'>-->
                    @foreach($bottoms as $item)
                        <div class="item bottoms">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="Bottoms"></span>
                            </a>
                        </div>
                    @endforeach
                </section>

            {{ $bottoms->fragment('tab-head')->links() }}
            </div>

      
            

            <!--ワンピースー-->
            <div class="swiper-slide">
                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".onepiece"-->
                <!--  }'>-->
                @foreach($onepiece as $item)
                        <div class="item onepiece">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="One-piece"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
            {{ $onepiece->fragment('tab-head')->links() }}
            </div> 
            

            <!--オールインワンー-->
            <div class="swiper-slide">
                                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".allinone"-->
                <!--  }'>-->
                    @foreach($allinone as $item)
                        <div class="item allinone">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="All-in-one"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
            {{ $allinone->fragment('tab-head')->links() }}
            </div> 


            <!--アウター-->
            <div class="swiper-slide">
                                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".outer"-->
                <!--  }'>-->
                    @foreach($outer as $item)
                        <div class="item outer">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="Outer"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
                {{ $outer->fragment('tab-head')->links() }}
            </div> 
   

            <!--靴ー-->
            <div class="swiper-slide">
                                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".shoes"-->
                <!--  }'>-->
                    @foreach($shoes as $item)
                        <div class="item shoes">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="Shoes"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
                {{ $shoes->fragment('tab-head')->links() }}
            </div> 

            <!--バッグー-->
            <div class="swiper-slide">
                                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".bag"-->
                <!--  }'>-->
                    @foreach($bag as $item)
                        <div class="item bag">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="Bag"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
                {{ $bag->fragment('tab-head')->links() }}
            </div> 

            <!--小物ー-->
            <div class="swiper-slide">
                                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".accessory"-->
                <!--  }'>-->
                    @foreach($accessory as $item)
                        <div class="item accessory">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="Accessory"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
                {{ $accessory->fragment('tab-head')->links() }}
            </div> 

            <!--アクセサリー-->
            <div class="swiper-slide">
                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".jewelry"-->
                <!--  }'>-->
                    @foreach($jewelry as $item)
                        <div class="item jewelry">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="Jewelry"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
                {{ $jewelry->fragment('tab-head')->links() }}
            </div> 
            
         
        
            
            
        </div>
  </div>
  
  
</div>







        
        
 
<!--</div>-->
<!--</div>-->
<!--</div>-->
        
        
        
        
  
        
        
</main>
        
        
        <!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>-->
<!--            <div class="container">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="panel panel-default">-->
<!--                            <div class="panel-heading">Create New post</div>-->
<!--                            <div class="panel-body">-->
<!--                                <a href="{{ url("/post") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>-->
                                
                                <!--移植-->
<!--                                      <form method="GET" action="{{ url("item") }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">-->
<!--                                    <div class="input-group">-->
<!--                                        <input type="text" class="form-control" name="search" placeholder="Search...">-->
<!--                                        <span class="input-group-btn">-->
<!--                                            <button class="btn btn-info" type="submit">-->
<!--                                                <span>Search</span>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                    </div>-->
<!--                                </form>-->
                                <!--//移植-->
<!--                                <br />-->
<!--                                <br />-->

<!--                                @if ($errors->any())-->
<!--                                    <ul class="alert alert-danger">-->
<!--                                        @foreach ($errors->all() as $error)-->
<!--                                            <li>{{ $error }}</li>-->
<!--                                        @endforeach-->
<!--                                    </ul>-->
<!--                                @endif-->
                                
                                
                                <!--追加-->
                                
                                
<!--    <main>-->
<!--          <h1>タイトル</h1>-->
<!--      <form action="/post/store" method="POST">-->
<!--           {{ csrf_field() }}-->
<!--        <div style="margin-bottom:20px">-->
<!--            <div><label for="title">誰に着せたい妄想コーデを作る？(●字/30文字)</label></div>-->
<!--            <div><input type="text"  placeholder="こんな夢がかなう（例：10kg痩せる○○になれる/○○に行ける）" id="title" name="title" maxlength="30" required>なら</div>-->
<!--            <div><input type="text"  placeholder="誰（例：私/推しアイドル/好きなキャラ）" id="who" name="who" maxlength="30" required>に着せたい妄想コーデ</div>-->
<!--        </div>-->

<!--      <div>-->
<!--      <div>アイテムリストから画像を6つ選択</div>-->
<!--        <img src="{{ asset('assets/img/default.jpg') }}" id="item1" style="width:50px" class="item" alt="">            -->
<!--        <img src="{{ asset('assets/img/default.jpg') }}" id="item2" style="width:50px" class="item" alt="">-->
<!--        <img src="{{ asset('assets/img/default.jpg') }}" id="item3" style="width:50px" class="item" alt="">-->
<!--        <img src="{{ asset('assets/img/default.jpg') }}" id="item4" style="width:50px" class="item" alt="">-->
<!--        <img src="{{ asset('assets/img/default.jpg') }}" id="item5" style="width:50px" class="item" alt="">-->
<!--        <img src="{{ asset('assets/img/default.jpg') }}" id="item6" style="width:50px" class="item" alt="">-->
<!--      </div>-->




        <!-- 商品画像 -->
<!--        <input id="img1" type="hidden" name="img1" value="">-->
<!--        <input id="img2" type="hidden" name="img2" value="">-->
<!--        <input id="img3" type="hidden" name="img3" value="">-->
<!--        <input id="img4" type="hidden" name="img4" value="">-->
<!--        <input id="img5" type="hidden" name="img5" value="">-->
<!--        <input id="img6" type="hidden" name="img6" value="">-->
        <!-- 商品URL -->
<!--        <input id="url1" type="hidden" name="url1" value="">-->
<!--        <input id="url2" type="hidden" name="url2" value="">-->
<!--        <input id="url3" type="hidden" name="url3" value="">-->
<!--        <input id="url4" type="hidden" name="url4" value="">-->
<!--        <input id="url5" type="hidden" name="url5" value="">-->
<!--        <input id="url6" type="hidden" name="url6" value="">-->
        
        <!-- 商品価格 -->
<!--        <input id="price1" type="hidden" name="price1" value="">-->
<!--        <input id="price2" type="hidden" name="price2" value="">-->
<!--        <input id="price3" type="hidden" name="price3" value="">-->
<!--        <input id="price4" type="hidden" name="price4" value="">-->
<!--        <input id="price5" type="hidden" name="price5" value="">-->
<!--        <input id="price6" type="hidden" name="price6" value="">-->
        

<!--        <div><input id="submit" type="hidden" value="アイテム決定"></div>-->
<!--      </form>-->

<!--<div>アイテムリストswiper</div>-->

<!--<div id="main">-->
<!--  <div class="container">-->
        <!-- メニュー部分 -->
<!--        <div class="swiper-container tab-menu">-->
<!--          <div class="swiper-wrapper" style="height:40px;">-->
<!--            <div class="swiper-slide">ALL</div>-->
<!--            <div class="swiper-slide">トップス</div>-->
<!--            <div class="swiper-slide">ボトムス</div>-->
<!--            <div class="swiper-slide">アウター</div>-->
<!--            <div class="swiper-slide">ワンピース</div>-->
<!--            <div class="swiper-slide">オールインワン</div>-->
<!--            <div class="swiper-slide">靴</div>-->
<!--            <div class="swiper-slide">バッグ・小物</div>-->
<!--            <div class="swiper-slide">アクセサリー</div>-->
<!--            <div class="swiper-slide">その他</div>-->
<!--          </div>-->
<!--        </div>-->
        <!-- コンテンツ部分 -->
<!--        <div class="swiper-container tab-contents" style="overflow: visible">-->
<!--          <div class="swiper-wrapper">-->

            <!--ALL-->
<!--            <div class="swiper-slide">-->
<!--                <div class="cssgrid">-->

<!--                </div>-->
<!--            </div>-->
            
            <!--トップス-->
<!--            <div class="swiper-slide">-->

                <!--<div class="cssgrid" id="api">-->


 
<!--                </div>-->
<!--            </div>-->
            
            <!--ボトムス-->
<!--            <div class="swiper-slide">-->
<!--                <div class="cssgrid" >-->
<!--            ボトムス-->
<!--                </div>-->
<!--            </div>-->
            
            <!--アウター-->
<!--            <div class="swiper-slide">-->

<!--                <div class="cssgrid">-->
<!--            アウター-->
<!--                </div>-->
<!--            </div>-->
            
            <!--ワンピース-->
<!--            <div class="swiper-slide">-->
<!--           <div class="cssgrid">-->
<!--               ワンピース-->
<!--                </div>-->
<!--            </div>-->
            
            <!--オールインワン-->
<!--            <div class="swiper-slide">-->

<!--                <div class="cssgrid">-->
<!--            オールインワン-->
<!--                </div>-->
<!--            </div>-->
            
            <!--靴-->
<!--            <div class="swiper-slide">-->
<!--                <div class="cssgrid">-->
<!--            靴-->
<!--                </div>-->
<!--            </div>-->
            
            <!--バッグ・小物-->
<!--            <div class="swiper-slide">-->

<!--                <div class="cssgrid">-->
<!--            バッグ・小物-->
<!--                </div>-->
<!--            </div>-->
            
            <!--アクセサリー-->
<!--            <div class="swiper-slide">-->
<!--                <div class="cssgrid">-->
<!--            アクセサリー-->
<!--                </div>-->
<!--            </div>-->
            
            <!--その他-->
<!--            <div class="swiper-slide">-->

<!--                <div class="cssgrid">-->
<!--            その他-->
<!--                </div>-->
<!--            </div>-->
            
            
<!--          </div>-->
<!--        </div>-->
<!--  </div>-->
<!--</div>-->





      
    <!--<div>Ajax</div>-->
    <!--<div class="cssgrid" id="api"></div>-->



<!--        </main>-->
        
             
                                
                                <!--//追加-->
                                

<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        @endsection
    