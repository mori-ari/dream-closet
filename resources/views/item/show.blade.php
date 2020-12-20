
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">item {{ $item->id }}</div>
                            <div class="panel-body">

                                <a href="{{ url("item") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <a href="{{ url("item") ."/". $item->id . "/edit" }}" title="Edit item"><button class="btn btn-primary btn-xs">Edit</button></a>
                                <form method="POST" action="/item/{{ $item->id }}" class="form-horizontal" style="display:inline;">
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
										<tr><th>id</th><td>{{$item->id}} </td></tr>
										<tr><th>itemCode</th><td>{{$item->itemCode}} </td></tr>
										<tr><th>url</th><td>{{$item->url}} </td></tr>
										<tr><th>img</th><td>{{$item->img}} </td></tr>
										<tr><th>price</th><td>{{$item->price}} </td></tr>
										<tr><th>genreId</th><td>{{$item->genreId}} </td></tr>
										<tr><th>genreName</th><td>{{$item->genreName}} </td></tr>
										<tr><th>colorId</th><td>{{$item->colorId}} </td></tr>
										<tr><th>colorName</th><td>{{$item->colorName}} </td></tr>
										<tr><th>shopName</th><td>{{$item->shopName}} </td></tr>
										<tr><th>shopUrl</th><td>{{$item->shopUrl}} </td></tr>
										<tr><th>itemName</th><td>{{$item->itemName}} </td></tr>
										<tr><th>caption</th><td>{{$item->caption}} </td></tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    