
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Create New user</div>
                            <div class="panel-body">
                                <a href="{{ url("/user") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <br />
                                <br />

                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                
                                
                                <form method="POST" action="/user/store" class="form-horizontal">
                                    {{ csrf_field() }}

    										<div class="form-group">
                                        <label for="name" class="col-md-4 control-label">name: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="name" type="text" id="name" value="{{old('name')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="email" class="col-md-4 control-label">email: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="email" type="text" id="email" value="{{old('email')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="email_verified_at" class="col-md-4 control-label">email_verified_at: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="email_verified_at" type="text" id="email_verified_at" value="{{old('email_verified_at')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="password" class="col-md-4 control-label">password: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="password" type="text" id="password" value="{{old('password')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="remember_token" class="col-md-4 control-label">remember_token: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="remember_token" type="text" id="remember_token" value="{{old('remember_token')}}">
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4">
                                            <input class="btn btn-primary" type="submit" value="Create">
                                        </div>
                                    </div>     
                                </form>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    