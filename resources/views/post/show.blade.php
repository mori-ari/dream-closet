@extends("layouts.app")
@section('title', 'あの人に着せたい妄想コーデを作成しよう')
@section('description', '妄想コーデを作成してTwitterに投稿しませんか？')
@section('url')post/{{ $post->uid }}@endsection
@section('ogimage'){{ $post->uid }}@endsection

    @section("content")
        
    <!--追加-->
<div id="wp">
<div>
<!-- 生成画像 -->
<img src="/storage/img/{{ $post->uid }}.png" id="output" style="width:600px"> 


</div>

<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter" data-hashtags="○○に着せたい妄想コーデ"　data-via="moriari2" data-show-count="false">
Twitterでシェア
</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>



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

// <a href="{{ $post->url6}}" target="_blank">
// <div class="polaroid-even">
//   <p>￥{{ $post->price6}}</p>
//   <img src="{{ $post->img6}}" />
//   <div class="circle-even"></div>
//   <div class="circle_l-even"></div>
//   <div class="check-even">Check→</div>
// </div>
// </a>


</div>

        
        
        
        
        
        
        
        
           <br><br><br><br><br><br><br><br><br>     
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">post {{ $post->uid }}</div>
                            <div class="panel-body">

                                <a href="{{ url("post") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <a href="{{ url("post") ."/". $post->uid . "/edit" }}" title="Edit post"><button class="btn btn-primary btn-xs">Edit</button></a>
                                <form method="POST" action="/post/{{ $post->uid }}" class="form-horizontal" style="display:inline;">
                                        {{ csrf_field() }}
                                        {{ method_field("delete") }}
                                        <button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm('Confirm delete')">
                                        Delete
                                        </button>    
                            </form>


                            
                            

                            
                            
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
    