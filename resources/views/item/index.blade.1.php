
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">item</div>
                            <div class="panel-body">
                            
                            
                                <a href="{{ url("item/create") }}" class="btn btn-success btn-sm" title="Add New item">
                                    Add New
                                </a>

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


                                <br/>
                                <br/>
                                
                                
                                
                                
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr><th>id</th><th>itemCode</th><th>url</th><th>img</th><th>price</th><th>genreId</th><th>genreName</th><th>colorId</th><th>colorName</th><th>shopName</th><th>shopUrl</th><th>itemName</th><th>caption</th></tr>
                                        </thead>
                                        <tbody>
                                        @foreach($item as $item)
                                    
                                    <tr>

                                            <td>{{ $item->id}} </td>

                                            <td>{{ $item->itemCode}} </td>

                                            <td>{{ $item->url}} </td>

                                            <td>{{ $item->img}} </td>

                                            <td>{{ $item->price}} </td>

                                            <td>{{ $item->genreId}} </td>

                                            <td>{{ $item->genreName}} </td>

                                            <td>{{ $item->colorId}} </td>

                                            <td>{{ $item->colorName}} </td>

                                            <td>{{ $item->shopName}} </td>

                                            <td>{{ $item->shopUrl}} </td>

                                            <td>{{ $item->itemName}} </td>

                                            <td>{{ $item->caption}} </td>
  
                                                <td><a href="{{ url("/item/" . $item->id) }}" title="View item"><button class="btn btn-info btn-xs">View</button></a></td>
                                                <td><a href="{{ url("/item/" . $item->id . "/edit") }}" title="Edit item"><button class="btn btn-primary btn-xs">Edit</button></a></td>
                                                <td>
                                                    <form method="POST" action="/item/{{ $item->id }}" class="form-horizontal" style="display:inline;">
                                                        {{ csrf_field() }}
                                                        
                                                        {{ method_field("DELETE") }}
                                                        <button type="submit" class="btn btn-danger btn-xs" title="Delete User" onclick="return confirm('Confirm delete')">
                                                        Delete
                                                        </button>    
                                                    </form>
                                                   </td>
                                              </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
<div class="pagination-wrapper"> {!! $item->appends(["search" => Request::get("search")])->render() !!} </div>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    