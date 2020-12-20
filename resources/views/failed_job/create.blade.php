
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Create New failed_job</div>
                            <div class="panel-body">
                                <a href="{{ url("/failed_job") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <br />
                                <br />

                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                
                                
                                <form method="POST" action="/failed_job/store" class="form-horizontal">
                                    {{ csrf_field() }}

    										<div class="form-group">
                                        <label for="connection" class="col-md-4 control-label">connection: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="connection" type="text" id="connection" value="{{old('connection')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="queue" class="col-md-4 control-label">queue: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="queue" type="text" id="queue" value="{{old('queue')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="payload" class="col-md-4 control-label">payload: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="payload" type="text" id="payload" value="{{old('payload')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="exception" class="col-md-4 control-label">exception: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="exception" type="text" id="exception" value="{{old('exception')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="failed_at" class="col-md-4 control-label">failed_at: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" required="required" name="failed_at" type="text" id="failed_at" value="{{old('failed_at')}}">
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
    