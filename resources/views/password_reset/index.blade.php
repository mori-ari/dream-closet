
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">password_reset</div>
                            <div class="panel-body">
                            
                            
                                <a href="{{ url("password_reset/create") }}" class="btn btn-success btn-sm" title="Add New password_reset">
                                    Add New
                                </a>

                                <form method="GET" action="{{ url("password_reset") }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                            <tr><th>email</th><th>token</th><th>created_at</th></tr>
                                        </thead>
                                        <tbody>
                                        @foreach($password_reset as $item)
                                    
                                    <tr>

                                            <td>{{ $item->email}} </td>

                                            <td>{{ $item->token}} </td>

                                            <td>{{ $item->created_at}} </td>
  
                                                <td><a href="{{ url("/password_reset/" . $item->) }}" title="View password_reset"><button class="btn btn-info btn-xs">View</button></a></td>
                                                <td><a href="{{ url("/password_reset/" . $item-> . "/edit") }}" title="Edit password_reset"><button class="btn btn-primary btn-xs">Edit</button></a></td>
                                                <td>
                                                    <form method="POST" action="/password_reset/{{ $item-> }}" class="form-horizontal" style="display:inline;">
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
                                    <div class="pagination-wrapper"> {!! $password_reset->appends(["search" => Request::get("search")])->render() !!} </div>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    