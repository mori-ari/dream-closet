
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">post</div>
                            <div class="panel-body">
                            
                            
                                <a href="{{ url("post/create") }}" class="btn btn-success btn-sm" title="Add New post">
                                    Add New
                                </a>

                                <form method="GET" action="{{ url("post") }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                            <tr><th>id</th><th>uid</th><th>title</th><th>img1</th><th>img2</th><th>img3</th><th>img4</th><th>img5</th><th>img6</th><th>url1</th><th>url2</th><th>url3</th><th>url4</th><th>url5</th><th>url6</th><th>price1</th><th>price2</th><th>price3</th><th>price4</th><th>price5</th><th>price6</th></tr>
                                        </thead>
                                        <tbody>
                                        @foreach($post as $item)
                                    
                                    <tr>

                                            <td>{{ $item->id}} </td>

                                            <td>{{ $item->uid}} </td>

                                            <td>{{ $item->title}} </td>

                                            <td>{{ $item->img1}} </td>

                                            <td>{{ $item->img2}} </td>

                                            <td>{{ $item->img3}} </td>

                                            <td>{{ $item->img4}} </td>

                                            <td>{{ $item->img5}} </td>

                                            <td>{{ $item->img6}} </td>

                                            <td>{{ $item->url1}} </td>

                                            <td>{{ $item->url2}} </td>

                                            <td>{{ $item->url3}} </td>

                                            <td>{{ $item->url4}} </td>

                                            <td>{{ $item->url5}} </td>

                                            <td>{{ $item->url6}} </td>

                                            <td>{{ $item->price1}} </td>

                                            <td>{{ $item->price2}} </td>

                                            <td>{{ $item->price3}} </td>

                                            <td>{{ $item->price4}} </td>

                                            <td>{{ $item->price5}} </td>

                                            <td>{{ $item->price6}} </td>
  
                                                <td><a href="{{ url("/post/" . $item->id) }}" title="View post"><button class="btn btn-info btn-xs">View</button></a></td>
                                                <td><a href="{{ url("/post/" . $item->id . "/edit") }}" title="Edit post"><button class="btn btn-primary btn-xs">Edit</button></a></td>
                                                <td>
                                                    <form method="POST" action="/post/{{ $item->id }}" class="form-horizontal" style="display:inline;">
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
                                    <div class="pagination-wrapper"> {!! $post->appends(["search" => Request::get("search")])->render() !!} </div>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    