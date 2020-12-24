<?php 
$uid = str_random(20); 
var_dump($uid);
?>
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Create New post</div>
                            <div class="panel-body">
                                <a href="{{ url("/post") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                
                                <!--移植-->
                                      <form method="GET" action="{{ url("item") }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info" type="submit">
                                                <span>Search</span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                                <!--//移植-->
                                <br />
                                <br />

                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                
                                
                                <!--追加-->
                                    <main>
          <h1>タイトル</h1>
      <form action="/post/store" method="POST">
           {{ csrf_field() }}
        <div style="margin-bottom:20px">
            <div><label for="title">誰に着せたい妄想コーデを作る？（全角10文字以内）</label></div>
            <div><input type="text"  placeholder="(例)ああああ" id="title" name="title" maxlength="10" required></div>
        </div>

      <div>
      <div>アイテムリストから画像を6つ選択</div>
        <img src="{{ asset('assets/img/default.jpg') }}" id="item1" style="width:50px" class="item" alt="">            
        <img src="{{ asset('assets/img/default.jpg') }}" id="item2" style="width:50px" class="item" alt="">
        <img src="{{ asset('assets/img/default.jpg') }}" id="item3" style="width:50px" class="item" alt="">
        <img src="{{ asset('assets/img/default.jpg') }}" id="item4" style="width:50px" class="item" alt="">
        <img src="{{ asset('assets/img/default.jpg') }}" id="item5" style="width:50px" class="item" alt="">
        <img src="{{ asset('assets/img/default.jpg') }}" id="item6" style="width:50px" class="item" alt="">
      </div>

        <!-- 商品画像 -->
        <input id="img1" type="hidden" name="img1" value="">
        <input id="img2" type="hidden" name="img2" value="">
        <input id="img3" type="hidden" name="img3" value="">
        <input id="img4" type="hidden" name="img4" value="">
        <input id="img5" type="hidden" name="img5" value="">
        <input id="img6" type="hidden" name="img6" value="">
        <!-- 商品URL -->
        <input id="url1" type="hidden" name="url1" value="">
        <input id="url2" type="hidden" name="url2" value="">
        <input id="url3" type="hidden" name="url3" value="">
        <input id="url4" type="hidden" name="url4" value="">
        <input id="url5" type="hidden" name="url5" value="">
        <input id="url6" type="hidden" name="url6" value="">
        
        <!-- 商品価格 -->
        <input id="price1" type="hidden" name="price1" value="">
        <input id="price2" type="hidden" name="price2" value="">
        <input id="price3" type="hidden" name="price3" value="">
        <input id="price4" type="hidden" name="price4" value="">
        <input id="price5" type="hidden" name="price5" value="">
        <input id="price6" type="hidden" name="price6" value="">
        
        <!--ランダム文字列-->
        <input id="uid" type="hidden" name="uid" value="{{ $uid }}">
        

        <div><input id="submit" type="hidden" value="アイテム決定"></div>
      </form>
<br>

      <div>アイテムリスト</div>
    <div class="cssgrid">
      @foreach($item as $item)

      <div class="item">
        <img src="{{ $item->img}}" class="img">
        <a href="{{ $item->url}}" class="url" target="_blank">
            <span class="price" data-id="{{ $item->price}}">{{ $item->price}}円</span>
        </a>
    　</div>
      @endforeach
    </div>
      
      
    <div>Ajax</div>
    <div class="cssgrid" id="api"></div>
        </main>
        
    <footer id="footer">
        <div id="copywrite">(c) copyright</div>
    </footer>
                                
                                
                                <!--//追加-->
                                
                                
                                <form method="POST" action="/post/store" class="form-horizontal">
                                    {{ csrf_field() }}

    										<div class="form-group">
                                        <label for="uid" class="col-md-4 control-label">uid: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="uid" type="text" id="uid" value="{{old('uid')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="title" class="col-md-4 control-label">title: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="title" type="text" id="title" value="{{old('title')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="img1" class="col-md-4 control-label">img1: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="img1" type="text" id="img1" value="{{old('img1')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="img2" class="col-md-4 control-label">img2: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="img2" type="text" id="img2" value="{{old('img2')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="img3" class="col-md-4 control-label">img3: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="img3" type="text" id="img3" value="{{old('img3')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="img4" class="col-md-4 control-label">img4: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="img4" type="text" id="img4" value="{{old('img4')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="img5" class="col-md-4 control-label">img5: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="img5" type="text" id="img5" value="{{old('img5')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="img6" class="col-md-4 control-label">img6: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="img6" type="text" id="img6" value="{{old('img6')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="url1" class="col-md-4 control-label">url1: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="url1" type="text" id="url1" value="{{old('url1')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="url2" class="col-md-4 control-label">url2: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="url2" type="text" id="url2" value="{{old('url2')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="url3" class="col-md-4 control-label">url3: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="url3" type="text" id="url3" value="{{old('url3')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="url4" class="col-md-4 control-label">url4: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="url4" type="text" id="url4" value="{{old('url4')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="url5" class="col-md-4 control-label">url5: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="url5" type="text" id="url5" value="{{old('url5')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="url6" class="col-md-4 control-label">url6: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="url6" type="text" id="url6" value="{{old('url6')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="price1" class="col-md-4 control-label">price1: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="price1" type="text" id="price1" value="{{old('price1')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="price2" class="col-md-4 control-label">price2: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="price2" type="text" id="price2" value="{{old('price2')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="price3" class="col-md-4 control-label">price3: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="price3" type="text" id="price3" value="{{old('price3')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="price4" class="col-md-4 control-label">price4: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="price4" type="text" id="price4" value="{{old('price4')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="price5" class="col-md-4 control-label">price5: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="price5" type="text" id="price5" value="{{old('price5')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="price6" class="col-md-4 control-label">price6: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="price6" type="text" id="price6" value="{{old('price6')}}">
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4">
                                            <input class="btn btn-primary" type="submit" value="Create">
                                        </div>
                                    </div>     
                                </form>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    