<?php
$who=$post->who;
$title=$post->title;
?>
@extends("layouts.app")
@section('title', $who.'が選ぶ #私の妄想コーデ')
@section('description', $who.'の'.$title)
@section('url')post/{{ $post->uid }}@endsection
@section('ogimage'){{ $post->uid }}@endsection

    @section("content")
<main>      

<div class="cover">
<!-- 生成画像 -->
<img src="/storage/img/{{ $post->uid }}.png" id="output"> 
</div>

<div class="tw tw-bg">
<div class="tw-box">
<div class="tw-txt">この妄想コーデを<br class="br-sp414" />Twitterでシェア！</div>
<div class="tw-bt">
<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-lang="jp" data-size="large" data-via="dreamCloset_jp" data-show-count="false" target="_blank"></a>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>
</div>
</div>



<div class="wrapper">
<div class="list">

<a href="{{ $post->url1}}" target="_blank">
<div class="polaroid">
    <p id="price_1" class="price_l">¥{{ $post->price1}}</p>
    <img src="{{ $post->img1}}" />
    <div class="circle"></div>
    <div class="circle_l"></div>
    <!--<div class="check">Check→</div>-->
    <div class="check">{{ $post->genre1}}</div>
</div>
<div class="bt-area">
    <a href="{{ $post->url1}}" target="_blank"><button class="bt-w">商品詳細</button></a>
</div>
</a>


<a href="{{ $post->url2}}" target="_blank">
<div class="polaroid-even">
  <p id="price_2" class="price_l-even">¥{{ $post->price2}}</p>
  <img src="{{ $post->img2}}" />
  <div class="circle-even"></div>
  <div class="circle_l-even"></div>
  <!--<div class="check-even">Check→</div>-->
  <div class="check-even">{{ $post->genre2}}</div>
</div>
<div class="bt-area-even">
    <a href="{{ $post->url2}}" target="_blank"><button class="bt-w">商品詳細</button></a>
</div>
</a>

<a href="{{ $post->url3}}" target="_blank">
<div class="polaroid">
  <p id="price_3" class="price_l">¥{{ $post->price3}}</p>
  <img src="{{ $post->img3}}" />
  <div class="circle"></div>
  <div class="circle_l"></div>
  <!--<div class="check">Check→</div>-->
  <div class="check">{{ $post->genre3}}</div>
</div>
<div class="bt-area">
    <a href="{{ $post->url3}}" target="_blank"><button class="bt-w">商品詳細</button></a>
</div>
</a>

<a href="{{ $post->url4}}" target="_blank">
<div class="polaroid-even">
  <p id="price_4" class="price_l-even">¥{{ $post->price4}}</p>
  <img src="{{ $post->img4}}" />
  <div class="circle-even"></div>
  <div class="circle_l-even"></div>
  <!--<div class="check-even">Check→</div>-->
  <div class="check-even">{{ $post->genre4}}</div>
</div>
<div class="bt-area-even">
    <a href="{{ $post->url4}}" target="_blank"><button class="bt-w">商品詳細</button></a>
</div>
</a>

</div>



<small class="kome">
  <li>価格は作成時の情報を表示しています。最新の商品情報は商品詳細をご確認ください。</li>
  <li>商品画像や商品詳細ページが表示されない場合は販売が終了している可能性がございます。</li>
  <li>商品に関するご質問は各ショップへお問い合わせください。</li>
</small>

<div class="tw">
<div class="tw-box">
<div class="tw-txt">この妄想コーデを<br class="br-sp414" />Twitterでシェア！</div>
<div class="tw-bt">
<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-lang="jp" data-size="large" data-via="dreamCloset_jp" data-show-count="false" target="_blank"></a>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>
</div>
</div>

<a href="{{ url("post/") }}"><button class="bt">妄想コーデを作成する</button></a>
<a href="{{ url("/") }}"><button class="bt-w">みんなの妄想コーデをCheck</button></a>
        
        
        
        
</main>        
        

@endsection
    