@extends("layouts.app")
@section('title', 'タイトル')
@section('description', 'ディスクリプション')
@section('url', 'ページURL')
@section('ogimage', 'og画像')
        @section("content")
        
<main>
<h1>#私の妄想コーデ</h1>
<div style="width:400px;margin:auto;text-align:center">
<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
<a href="{{ url("post/") }}"><button>妄想コーデを作成する</button></a>
</div>
<div style="margin:40px">
         @foreach($post as $item)
        <a href="{{ url("/post/" . $item->uid) }}">
        <img src="/storage/img/{{ $item->uid }}.png" style="width:20px">
        </a>
        @endforeach
        </div>
        
        
</main>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>-->
        
            <!--<div class="container">-->
            <!--    <div class="row">-->
            <!--        <div class="col-md-12">-->
            <!--            <div class="panel panel-default">-->
            <!--                <div class="panel-heading">post</div>-->
            <!--                <div class="panel-body">-->
                            
                            
            <!--                    <a href="{{ url("post/create") }}" class="btn btn-success btn-sm" title="Add New post">-->
            <!--                        妄想コーデを作成する-->
            <!--                    </a>-->

            <!--                    <form method="GET" action="{{ url("post") }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">-->
            <!--                        <div class="input-group">-->
            <!--                            <input type="text" class="form-control" name="search" placeholder="Search...">-->
            <!--                            <span class="input-group-btn">-->
            <!--                                <button class="btn btn-info" type="submit">-->
            <!--                                    <span>Search</span>-->
            <!--                                </button>-->
            <!--                            </span>-->
            <!--                        </div>-->
            <!--                    </form>-->


            <!--                    <br/>-->
            <!--                    <br/>-->
                                
                                
            <!--                    <div class="table-responsive">-->
            <!--                        <table class="table table-borderless">-->
            <!--                            <thead>-->
            <!--                                <tr><th>id</th><th>uid</th><th>title</th><th>img1</th><th>img2</th><th>img3</th><th>img4</th><th>img5</th><th>img6</th></tr>-->
            <!--                            </thead>-->
            <!--                            <tbody>-->
            <!--                            @foreach($post as $item)-->
                                    
            <!--                        <tr>-->

            <!--                                <td>{{ $item->id}}</td>-->

            <!--                                <td>{{ $item->uid}}<br><img src="/storage/img/{{ $item->uid }}.png" style="width:200px"> </td>-->

            <!--                                <td>もしも{{ $item->title}}なら{{ $item->who}}に着せたい妄想コーデ </td>-->

            <!--                                <td><a href="{{ $item->url1}}"><image src="{{ $item->img1}}" style="width:70px"><br>{{ $item->price1}}</a></td>-->

            <!--                                <td><a href="{{ $item->url2}}"><image src="{{ $item->img2}}" style="width:70px"><br>{{ $item->price2}}</a></td>-->

            <!--                                <td><a href="{{ $item->url3}}"><image src="{{ $item->img3}}" style="width:70px"><br>{{ $item->price3}}</a></td>-->

            <!--                                <td><a href="{{ $item->url4}}"><image src="{{ $item->img4}}" style="width:70px"><br>{{ $item->price4}}</a></td>-->

            <!--                                <td><a href="{{ $item->url5}}"><image src="{{ $item->img5}}" style="width:70px"><br>{{ $item->price5}}</a></td>-->

            <!--                                <td><a href="{{ $item->url6}}"><image src="{{ $item->img6}}" style="width:70px"><br>{{ $item->price6}}</a></td>-->

            <!--                 <td><a href="{{ url("/post/" . $item->uid) }}" title="View post"><button class="btn btn-info btn-xs">View</button></a></td>-->
            <!--                                    <td><a href="{{ url("/post/" . $item->id . "/edit") }}" title="Edit post"><button class="btn btn-primary btn-xs">Edit</button></a></td>-->
            <!--                                    <td>-->
            <!--                                        <form method="POST" action="/post/{{ $item->id }}" class="form-horizontal" style="display:inline;">-->
            <!--                                            {{ csrf_field() }}-->
                                                        
            <!--                                            {{ method_field("DELETE") }}-->
            <!--                                            <button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm('Confirm delete')">-->
            <!--                                            Delete-->
            <!--                                            </button>    -->
            <!--                                        </form>-->
            <!--                                       </td>-->
            <!--                                  </tr>-->

            <!--                            @endforeach-->
            <!--                            </tbody>-->
            <!--                        </table>-->
            <!--                        <div class="pagination-wrapper"> {!! $post->appends(["search" => Request::get("search")])->render() !!} </div>-->
            <!--                    </div>-->
                                

            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            
            
            
            
            
            
        @endsection
    