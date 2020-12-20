
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Edit password_reset #{{ $password_reset-> }}</div>
                            <div class="panel-body">
                                <a href="{{ url("password_reset") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <br />
                                <br />

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
    
                            <form method="POST" action="/password_reset/{{ $password_reset-> }}" class="form-horizontal">
                                        {{ csrf_field() }}
                                        {{ method_field("PUT") }}
            
										<div class="form-group">
                                            <label for="email" class="col-md-4 control-label">email: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" required="required" name="email" type="text" id="email" value="{{$password_reset->email}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="token" class="col-md-4 control-label">token: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" required="required" name="token" type="text" id="token" value="{{$password_reset->token}}">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="created_at" class="col-md-4 control-label">created_at: </label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="created_at" type="text" id="created_at" value="{{$password_reset->created_at}}">
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
    