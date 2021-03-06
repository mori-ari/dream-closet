
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Create New posts_item</div>
                            <div class="panel-body">
                                <a href="{{ url("/posts_item") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <br />
                                <br />

                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                
                                
                                <form method="POST" action="/posts_item/store" class="form-horizontal">
                                    {{ csrf_field() }}

    										<div class="form-group">
                                        <label for="post_id" class="col-md-4 control-label">post_id: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="post_id" type="text" id="post_id" value="{{old('post_id')}}">
                                        </div>
                                    </div>
										<div class="form-group">
                                        <label for="item_id" class="col-md-4 control-label">item_id: </label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="item_id" type="text" id="item_id" value="{{old('item_id')}}">
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
    