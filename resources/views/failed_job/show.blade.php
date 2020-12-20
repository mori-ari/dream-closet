
        @extends("layouts.app")
        @section("content")
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">failed_job {{ $failed_job->id }}</div>
                            <div class="panel-body">

                                <a href="{{ url("failed_job") }}" title="Back"><button class="btn btn-warning btn-xs">Back</button></a>
                                <a href="{{ url("failed_job") ."/". $failed_job->id . "/edit" }}" title="Edit failed_job"><button class="btn btn-primary btn-xs">Edit</button></a>
                                <form method="POST" action="/failed_job/{{ $failed_job->id }}" class="form-horizontal" style="display:inline;">
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
										<tr><th>id</th><td>{{$failed_job->id}} </td></tr>
										<tr><th>connection</th><td>{{$failed_job->connection}} </td></tr>
										<tr><th>queue</th><td>{{$failed_job->queue}} </td></tr>
										<tr><th>payload</th><td>{{$failed_job->payload}} </td></tr>
										<tr><th>exception</th><td>{{$failed_job->exception}} </td></tr>
										<tr><th>failed_at</th><td>{{$failed_job->failed_at}} </td></tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    