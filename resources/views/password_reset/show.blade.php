
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">password_reset {{ $password_reset-> }}</div>
                            <div class="panel-body">

                                <a href="{{ url("password_reset") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <a href="{{ url("password_reset") ."/". $password_reset-> . "/edit" }}" title="Edit password_reset"><button class="btn btn-primary btn-xs">Edit</button></a>
                                <form method="POST" action="/password_reset/{{ $password_reset-> }}" class="form-horizontal" style="display:inline;">
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
										<tr><th>email</th><td>{{$password_reset->email}} </td></tr>
										<tr><th>token</th><td>{{$password_reset->token}} </td></tr>
										<tr><th>created_at</th><td>{{$password_reset->created_at}} </td></tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    