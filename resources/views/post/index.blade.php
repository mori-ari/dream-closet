@extends("layouts.app")
@section('title', '#私の妄想コーデ')
@section('description', '「もしも○○なら着たい服」「推しアイドルに着せたい服」、好きなアイテムを組み合わせてあなたの妄想コーデを作成しませんか？')
@section('url', '/')
@section('ogimage', 'ogp')
@section("content")
        
<main>
<h1><img src="{{ asset('assets/img/logo.png') }}" id="logo" alt="＃私の妄想コーデ"></h1>

<div class="description">
<div class="text-box">
<p>「こんな夢が叶ったら着たい服」<br>「推しアイドルに着せたいコーデ」<br>好きなアイテムを組み合わせて<br class="br-sp500" />あなたの妄想コーデを作成しませんか？</p>
</div>
<a href="{{ url("post/") }}"><button class="bt">妄想コーデを作成する</button></a>

</div>



<div class="contents">
        <h2><span>みんなの妄想コーデ</span></h2>

         @foreach($post as $item)

        <a  href="{{ url("/post/" . $item->uid) }}">
        <img class="ogp" src="/storage/img/{{ $item->uid }}.png">
        </a>

        @endforeach
</div>



</main>
  
            
        @endsection
    