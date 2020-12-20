
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">posts_item {{ $posts_item->id }}</div>
                            <div class="panel-body">

                                <a href="{{ url("posts_item") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <a href="{{ url("posts_item") ."/". $posts_item->id . "/edit" }}" title="Edit posts_item"><button class="btn btn-primary btn-xs">Edit</button></a>
                                <form method="POST" action="/posts_item/{{ $posts_item->id }}" class="form-horizontal" style="display:inline;">
                                        {{ csrf_field() }}
                                        {{ method_field("delete") }}
                                        <button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm('Confirm delete')">
                                        Delete
                                        </button>    
                            </form>
                            <br/>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
										<tr><th>id</th><td>{{$posts_item->id}} </td></tr>
										<tr><th>post_id</th><td>{{$posts_item->post_id}} </td></tr>
										<tr><th>item_id</th><td>{{$posts_item->item_id}} </td></tr>
										<tr><th>uid</th><td>{{$posts_item->uid}} </td></tr>
										<tr><th>title</th><td>{{$posts_item->title}} </td></tr>
										<tr><th>img1</th><td>{{$posts_item->img1}} </td></tr>
										<tr><th>img2</th><td>{{$posts_item->img2}} </td></tr>
										<tr><th>img3</th><td>{{$posts_item->img3}} </td></tr>
										<tr><th>img4</th><td>{{$posts_item->img4}} </td></tr>
										<tr><th>img5</th><td>{{$posts_item->img5}} </td></tr>
										<tr><th>img6</th><td>{{$posts_item->img6}} </td></tr>
										<tr><th>url1</th><td>{{$posts_item->url1}} </td></tr>
										<tr><th>url2</th><td>{{$posts_item->url2}} </td></tr>
										<tr><th>url3</th><td>{{$posts_item->url3}} </td></tr>
										<tr><th>url4</th><td>{{$posts_item->url4}} </td></tr>
										<tr><th>url5</th><td>{{$posts_item->url5}} </td></tr>
										<tr><th>url6</th><td>{{$posts_item->url6}} </td></tr>
										<tr><th>price1</th><td>{{$posts_item->price1}} </td></tr>
										<tr><th>price2</th><td>{{$posts_item->price2}} </td></tr>
										<tr><th>price3</th><td>{{$posts_item->price3}} </td></tr>
										<tr><th>price4</th><td>{{$posts_item->price4}} </td></tr>
										<tr><th>price5</th><td>{{$posts_item->price5}} </td></tr>
										<tr><th>price6</th><td>{{$posts_item->price6}} </td></tr>
										<tr><th>itemCode</th><td>{{$posts_item->itemCode}} </td></tr>
										<tr><th>url</th><td>{{$posts_item->url}} </td></tr>
										<tr><th>img</th><td>{{$posts_item->img}} </td></tr>
										<tr><th>price</th><td>{{$posts_item->price}} </td></tr>
										<tr><th>genreId</th><td>{{$posts_item->genreId}} </td></tr>
										<tr><th>genreName</th><td>{{$posts_item->genreName}} </td></tr>
										<tr><th>colorId</th><td>{{$posts_item->colorId}} </td></tr>
										<tr><th>colorName</th><td>{{$posts_item->colorName}} </td></tr>
										<tr><th>shopName</th><td>{{$posts_item->shopName}} </td></tr>
										<tr><th>shopUrl</th><td>{{$posts_item->shopUrl}} </td></tr>
										<tr><th>itemName</th><td>{{$posts_item->itemName}} </td></tr>
										<tr><th>caption</th><td>{{$posts_item->caption}} </td></tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    