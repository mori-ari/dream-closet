<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Validate;
use DB;
use App\FailedJob;
    
    //=======================================================================
    class FailedJobsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\View\View
         */
        public function index(Request $request)
        {
            $keyword = $request->get("search");
            $perPage = 25;
    
            if (!empty($keyword)) {
                
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [failed_jobs]--
				// ----------------------------------------------------
				$failed_job = DB::table("failed_jobs")
				->orWhere("failed_jobs.connection", "LIKE", "%$keyword%")->orWhere("failed_jobs.queue", "LIKE", "%$keyword%")->orWhere("failed_jobs.payload", "LIKE", "%$keyword%")->orWhere("failed_jobs.exception", "LIKE", "%$keyword%")->orWhere("failed_jobs.failed_at", "LIKE", "%$keyword%")->select("*")->addSelect("failed_jobs.id")->paginate($perPage);
            } else {
                    //$failed_job = FailedJob::paginate($perPage);
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [failed_jobs]--
				// ----------------------------------------------------
				$failed_job = DB::table("failed_jobs")
				->select("*")->addSelect("failed_jobs.id")->paginate($perPage);              
            }          
            return view("failed_job.index", compact("failed_job"));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\View\View
         */
        public function create()
        {
            return view("failed_job.create");
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function store(Request $request)
        {
            $this->validate($request, [
				"connection" => "required", //text('connection')
				"queue" => "required", //text('queue')
				"payload" => "required", //longText('payload')
				"exception" => "required", //longText('exception')
				"failed_at" => "required|date_format:Y-m-d H:i:s", //timestamp('failed_at')

            ]);
            $requestData = $request->all();
            
            FailedJob::create($requestData);
    
            return redirect("failed_job")->with("flash_message", "failed_job added!");
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
        public function show($id)
        {
            //$failed_job = FailedJob::findOrFail($id);
            
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [failed_jobs]--
				// ----------------------------------------------------
				$failed_job = DB::table("failed_jobs")
				->select("*")->addSelect("failed_jobs.id")->where("failed_jobs.id",$id)->first();
            return view("failed_job.show", compact("failed_job"));
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         *
         * @return \Illuminate\View\View
         */
        public function edit($id)
        {
            $failed_job = FailedJob::findOrFail($id);
    
            return view("failed_job.edit", compact("failed_job"));
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  int  $id
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function update(Request $request, $id)
        {
            $this->validate($request, [
				"connection" => "required", //text('connection')
				"queue" => "required", //text('queue')
				"payload" => "required", //longText('payload')
				"exception" => "required", //longText('exception')
				"failed_at" => "required|date_format:Y-m-d H:i:s", //timestamp('failed_at')

            ]);
            $requestData = $request->all();
            
            $failed_job = FailedJob::findOrFail($id);
            $failed_job->update($requestData);
    
            return redirect("failed_job")->with("flash_message", "failed_job updated!");
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function destroy($id)
        {
            FailedJob::destroy($id);
    
            return redirect("failed_job")->with("flash_message", "failed_job deleted!");
        }
    }
    //=======================================================================
    
    