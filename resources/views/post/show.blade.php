<?php
function image() 
{
//ヘッダーの設定
header("Content-type: image/png");
 
//指定した大きさの黒画像を生成
$img = imagecreatetruecolor(1200, 628);

// コピー先画像のサイズ取得
$imgsize = getimagesize($file1);
$w = $imgsize[0];
$h = $imgsize[1];
 
//画像背景の設定
  //背景色の指定
  $background_color = imagecolorallocate($img, 255, 255, 255);
  //画像を背景色で塗る
  imagefilledrectangle($img, 0, 0, 1200, 628, $background_color);

// 出力画像
$img1 = imagecreatefromjpeg('{{ $post->img1}}');
$img2 = imagecreatefromjpeg('{{ $post->img2}}');
$img3 = imagecreatefromjpeg('{{ $post->img3}}');
$img4 = imagecreatefromjpeg('{{ $post->img4}}');
$img5 = imagecreatefromjpeg('{{ $post->img5}}');
$img6 = imagecreatefromjpeg('{{ $post->img6}}');

// // コピー元画像のサイズ取得
// list($w1, $h1) = getimagesize($img1);
// list($w2, $h2) = getimagesize($img2);
// list($w3, $h3) = getimagesize($img3);
// list($w4, $h4) = getimagesize($img4);
// list($w5, $h5) = getimagesize($img5);
// list($w6, $h6) = getimagesize($img6);

// $w1_w = $imagesize[0];
// $w1_h = $imagesize[1];

// // コピー元画像の配置後のサイズ計算
// $resize_w = $w / 4;
// $resize_h1 = $w1_h / ($w1_w / $resize_w);


// 画像配置
// imagecopy($img, $img1, 0, 0, 0, 0, 300, 300);
// imagecopy($img, $img2, 0, 300, 0, 0, 300, 300);
// imagecopy($img, $img3, 300, 300, 0, 0, 300, 300);
// imagecopy($img, $img4, 600, 300, 0, 0, 300, 300);
// imagecopy($img, $img5, 900, 300, 0, 0, 300, 300);
// imagecopy($img, $img6, 900, 0, 0, 0, 300, 300);

imagecopyresampled($img, $img1, 0, 0, 0, 0, 300, 300,900,900);
imagecopyresampled($img, $img2, 0, 300, 0, 0, 300, 300,900,900);
imagecopyresampled($img, $img3, 300, 300, 0, 0, 300, 300,900,900);
imagecopyresampled($img, $img4, 600, 300, 0, 0, 300, 300,900,900);
imagecopyresampled($img, $img5, 900, 300, 0, 0, 300, 300,900,900);
imagecopyresampled($img, $img6, 900, 0, 0, 0, 300, 300,900,900);


//出力テキスト
  //テキスト色の指定（R,G,B）
  $text_color = imagecolorallocate($img, 0, 0, 0);
  //画像に文字列を書き込む（文字サイズ,X,Y,テキスト,色）
  imagestring($img, 5, 330, 50,  'aaaaaaa', $text_color);
  imagestring($img, 5, 330, 150,  'kkkkkkkkkkk', $text_color);


 
//画像の出力
imagepng($img);
 
//画像の保存
imagepng($img, 'ogp/id.png');
 
//画像の消去（メモリの解放）
imagedestroy($img);
}

?>
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">post {{ $post->id }}</div>
                            <div class="panel-body">

                                <a href="{{ url("post") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <a href="{{ url("post") ."/". $post->id . "/edit" }}" title="Edit post"><button class="btn btn-primary btn-xs">Edit</button></a>
                                <form method="POST" action="/post/{{ $post->id }}" class="form-horizontal" style="display:inline;">
                                        {{ csrf_field() }}
                                        {{ method_field("delete") }}
                                        <button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm('Confirm delete')">
                                        Delete
                                        </button>    
                            </form>
                            <br/>
                            <br/>
                            
                            <!--追加-->
                            <div id="wp">
<div>

<!-- PHP画像テスト -->
 <img src="{{ asset('assets/img/uid.png') }}" id="output" style="width:500px"> 


</div>

<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter" data-hashtags="わたしの理想の6着"　data-via="moriari2" data-show-count="false">Twitterでシェア</a>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>



<a href="{{ $post->url1}}" target="_blank">
<div class="polaroid">
    <p>￥{{ $post->price1}}</p>
    <img src="{{ $post->img1}}" />
    <div class="circle"></div>
    <div class="circle_l"></div>
    <div class="check">Check→</div>
</div>


</a>

<a href="{{ $post->url2}}" target="_blank">
<div class="polaroid-even">
  <p>￥{{ $post->price2}}</p>
  <img src="{{ $post->img2}}" />
  <div class="circle-even"></div>
  <div class="circle_l-even"></div>
  <div class="check-even">Check→</div>
</div>
</a>

<a href="{{ $post->url3}}" target="_blank">
<div class="polaroid">
  <p>￥{{ $post->price3}}</p>
  <img src="{{ $post->img3}}" />
  <div class="circle"></div>
  <div class="circle_l"></div>
  <div class="check">Check→</div>
</div>
</a>

<a href="{{ $post->url4}}" target="_blank">
<div class="polaroid-even">
  <p>￥{{ $post->price4}}</p>
  <img src="{{ $post->img4}}" />
  <div class="circle-even"></div>
  <div class="circle_l-even"></div>
  <div class="check-even">Check→</div>
</div>
</a>

<a href="{{ $post->url5}}" target="_blank">
<div class="polaroid">
  <p>￥{{ $post->price5}}</p>
  <img src="{{ $post->img5}}" />
  <div class="circle"></div>
  <div class="circle_l"></div>
  <div class="check">Check→</div>
</div>
</a>

<a href="{{ $post->url6}}" target="_blank">
<div class="polaroid-even">
  <p>￥{{ $post->price6}}</p>
  <img src="{{ $post->img6}}" />
  <div class="circle-even"></div>
  <div class="circle_l-even"></div>
  <div class="check-even">Check→</div>
</div>
</a>


</div>

<footer>
    <div id="copywrite">(c) copyright</div>
</footer>

                            
                            
                            <!--追加-->
                            
                            
                            
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
										<tr><th>id</th><th>uid</th><th>title</th><th>img1</th><th>img2</th><th>img3</th><th>img4</th><th>img5</th><th>img6</th></tr>
										<tr>
										    <td>{{$post->id}} </td>
										    <td>{{$post->uid}} </td>
										    <td>{{$post->title}} </td>
										    <td><a href="{{ $post->url1}}"><image src="{{ $post->img1}}" style="width:70px"><br>{{ $post->price1}}</a></td>
										    <td><a href="{{ $post->url2}}"><image src="{{ $post->img2}}" style="width:70px"><br>{{ $post->price2}}</a></td>
										    <td><a href="{{ $post->url3}}"><image src="{{ $post->img3}}" style="width:70px"><br>{{ $post->price3}}</a></td>
										    <td><a href="{{ $post->url4}}"><image src="{{ $post->img4}}" style="width:70px"><br>{{ $post->price4}}</a></td>
										    <td><a href="{{ $post->url5}}"><image src="{{ $post->img5}}" style="width:70px"><br>{{ $post->price5}}</a></td>
										    <td><a href="{{ $post->url6}}"><image src="{{ $post->img6}}" style="width:70px"><br>{{ $post->price6}}</a></td>
										</tr>


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    