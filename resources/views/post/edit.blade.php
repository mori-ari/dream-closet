
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Edit post #{{ $post->id }}</div>
                            <div class="panel-body">
                                <a href="{{ url("post") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <br />
                                <br />

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
    
                            <form method="POST" action="/post/{{ $post->id }}" class="form-horizontal">
                                        {{ csrf_field() }}
                                        {{ method_field("PUT") }}
            
										<div class="form-group">
                                        <label for="id" class="col-md-4 control-label">id: </label>
                                        <div class="col-md-6">{{$post->id}}</div>
                                    </div>
										<div class="form-group">
                                            <label for="uid" class="col-md-4 control-label">uid: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="uid" type="text" id="uid" value="{{$post->uid}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="title" class="col-md-4 control-label">title: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="title" type="text" id="title" value="{{$post->title}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="img1" class="col-md-4 control-label">img1: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="img1" type="text" id="img1" value="{{$post->img1}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="img2" class="col-md-4 control-label">img2: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="img2" type="text" id="img2" value="{{$post->img2}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="img3" class="col-md-4 control-label">img3: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="img3" type="text" id="img3" value="{{$post->img3}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="img4" class="col-md-4 control-label">img4: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="img4" type="text" id="img4" value="{{$post->img4}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="img5" class="col-md-4 control-label">img5: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="img5" type="text" id="img5" value="{{$post->img5}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="img6" class="col-md-4 control-label">img6: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="img6" type="text" id="img6" value="{{$post->img6}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="url1" class="col-md-4 control-label">url1: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="url1" type="text" id="url1" value="{{$post->url1}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="url2" class="col-md-4 control-label">url2: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="url2" type="text" id="url2" value="{{$post->url2}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="url3" class="col-md-4 control-label">url3: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="url3" type="text" id="url3" value="{{$post->url3}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="url4" class="col-md-4 control-label">url4: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="url4" type="text" id="url4" value="{{$post->url4}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="url5" class="col-md-4 control-label">url5: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="url5" type="text" id="url5" value="{{$post->url5}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="url6" class="col-md-4 control-label">url6: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="url6" type="text" id="url6" value="{{$post->url6}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="price1" class="col-md-4 control-label">price1: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="price1" type="text" id="price1" value="{{$post->price1}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="price2" class="col-md-4 control-label">price2: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="price2" type="text" id="price2" value="{{$post->price2}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="price3" class="col-md-4 control-label">price3: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="price3" type="text" id="price3" value="{{$post->price3}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="price4" class="col-md-4 control-label">price4: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="price4" type="text" id="price4" value="{{$post->price4}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="price5" class="col-md-4 control-label">price5: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="price5" type="text" id="price5" value="{{$post->price5}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="price6" class="col-md-4 control-label">price6: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="price6" type="text" id="price6" value="{{$post->price6}}">
                                            </div>
                                        </div>
               
                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4">
                                            <input class="btn btn-primary" type="submit" value="Update">
                                        </div>
                                    </div>   
                                </form>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    