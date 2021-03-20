@extends("layouts.app")
@section('title', '妄想コーデを作成する | #私の妄想コーデ')
@section('description', '「もしも○○なら着たい服」「推しアイドルに着せたい服」、好きなアイテムを組み合わせてあなたの妄想コーデを作成しませんか？')
@section('url', 'post/')
@section('ogimage', 'ogp')
@section("content")
<!-- ローディング画面 -->
<div id="loading-wrapper">
    <div class="loader"></div>
</div>
<!-- コンテンツ部分 -->
<div id="page">

    
<main>
<h1>妄想コーデを作成する</h1>   


<div class="sample">
		<img src="{{ asset('/assets/img/sample.png') }}">
		<!--<p>Sample</p>-->
</div>

    <div class="form">

        <form action="/post/store" method="POST">
           {{ csrf_field() }}
           
        <div class="label">
        <span class="step">1</span>ニックネームを入力<span class="count">(<span class="name-count">0</span>/10字)</span>
        </div>

            <div class="cp_iptxt">
            	<label class="ef">
            		<input type="text" placeholder="ニックネーム" id="who" name="who" maxlength="10" required>
            	</label>
                    <!--<span class="attention">※結果画面に表示します</span>-->
            </div>

        <div class="label"><span class="step">2</span>どんな妄想コーデを作る？<span class="count">(<span class="show-count">0</span>/42字)</span></div>
            <div class="cp_iptxt">
            	<label class="ef">
            	<textarea placeholder="例：もしも○○が叶うなら着たい(○○に着せたい)妄想コーデ" id="title" name="title" maxlength="42" required></textarea>
            	<!--モーダル-->
            	<!--<div class="theme">-->
            	<!--    <div class="modalLink"><span class="icon-plus">＋</span>妄想テーマを選ぶ</div>-->
            	    <!--モーダル中身-->            	          
            	<!--    <div class="modal_off">-->
            	<!--        <div class="close"><span class="batsu"></span></div>-->
            	<!--        <li>あ</li> -->
            	<!--        <li>あ</li> -->
            	<!--        <li>あ</li> -->
            	<!--        <li>あ</li> -->
            	<!--        <li>あ</li> -->
            	<!--    </div>-->
             <!--   </div>-->
                
            	
            	</label>
            	
            </div>
            
        <div class="label"><span class="step step3">3</span>アイテム画像を選ぶ<!--<span class="count">(4～5点)</span>--></div>
            
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
            <div class="attention"></div>
       
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
     


      
      
  <div class="container" id="tab-head" >
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
        @include("post._parts", ["items" => $tops, "append" => "tops", "class"=>"Tops"])
        @include("post._parts", ["items" => $bottoms, "append" => "bottoms", "class"=>"Bottoms"])
        @include("post._parts", ["items" => $onepiece, "append" => "onepiece", "class"=>"One-piece"])
        @include("post._parts", ["items" => $allinone, "append" => "allinone", "class"=>"All-in-one"])
        @include("post._parts", ["items" => $outer, "append" => "outer", "class"=>"Outer"])
        @include("post._parts", ["items" => $shoes, "append" => "shoes", "class"=>"Shoes"])
        @include("post._parts", ["items" => $bag, "append" => "bag", "class"=>"Bag"])
        @include("post._parts", ["items" => $accessory, "append" => "accessory", "class"=>"Accessory"])
        @include("post._parts", ["items" => $jewelry, "append" => "jewelry", "class"=>"Jewelry"])


        </div>
  </div>
  
  
</div>
      
</main>




</div>
@endsection
    