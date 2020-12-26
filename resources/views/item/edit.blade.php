@extends("layouts.app")
@section('title', 'タイトル')
@section('description', 'ディスクリプション')
@section('url', 'ページURL')
@section('ogimage', 'og画像')
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Edit item #{{ $item->id }}</div>
                            <div class="panel-body">
                                <a href="{{ url("item") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <br />
                                <br />

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
    
                            <form method="POST" action="/item/{{ $item->id }}" class="form-horizontal">
                                        {{ csrf_field() }}
                                        {{ method_field("PUT") }}
            
										<div class="form-group">
                                        <label for="id" class="col-md-4 control-label">id: </label>
                                        <div class="col-md-6">{{$item->id}}</div>
                                    </div>
										<div class="form-group">
                                            <label for="itemCode" class="col-md-4 control-label">itemCode: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" required="required" name="itemCode" type="text" id="itemCode" value="{{$item->itemCode}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="url" class="col-md-4 control-label">url: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="url" type="text" id="url" value="{{$item->url}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="img" class="col-md-4 control-label">img: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="img" type="text" id="img" value="{{$item->img}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="price" class="col-md-4 control-label">price: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="price" type="text" id="price" value="{{$item->price}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="genreId" class="col-md-4 control-label">genreId: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="genreId" type="text" id="genreId" value="{{$item->genreId}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="genreName" class="col-md-4 control-label">genreName: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="genreName" type="text" id="genreName" value="{{$item->genreName}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="colorId" class="col-md-4 control-label">colorId: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="colorId" type="text" id="colorId" value="{{$item->colorId}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="colorName" class="col-md-4 control-label">colorName: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="colorName" type="text" id="colorName" value="{{$item->colorName}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="shopName" class="col-md-4 control-label">shopName: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="shopName" type="text" id="shopName" value="{{$item->shopName}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="shopUrl" class="col-md-4 control-label">shopUrl: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="shopUrl" type="text" id="shopUrl" value="{{$item->shopUrl}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="itemName" class="col-md-4 control-label">itemName: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="itemName" type="text" id="itemName" value="{{$item->itemName}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="caption" class="col-md-4 control-label">caption: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="caption" type="text" id="caption" value="{{$item->caption}}">
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
    