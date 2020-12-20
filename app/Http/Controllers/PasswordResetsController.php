<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Validate;
use DB;
use App\PasswordReset;
    
    //=======================================================================
    class PasswordResetsController extends Controller
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
				// -- QueryBuilder: SELECT [password_resets]--
				// ----------------------------------------------------
				$password_reset = DB::table("password_resets")
				->orWhere("password_resets.email", "LIKE", "%$keyword%")->orWhere("password_resets.token", "LIKE", "%$keyword%")->select("*")->addSelect("password_resets.id")->paginate($perPage);
            } else {
                    //$password_reset = PasswordReset::paginate($perPage);
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [password_resets]--
				// ----------------------------------------------------
				$password_reset = DB::table("password_resets")
				->select("*")->addSelect("password_resets.id")->paginate($perPage);              
            }          
            return view("password_reset.index", compact("password_reset"));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\View\View
         */
        public function create()
        {
            return view("password_reset.create");
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
				"email" => "required", //string('email')
				"token" => "required", //string('token')

            ]);
            $requestData = $request->all();
            
            PasswordReset::create($requestData);
    
            return redirect("password_reset")->with("flash_message", "password_reset added!");
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
            //$password_reset = PasswordReset::findOrFail($id);
            
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [password_resets]--
				// ----------------------------------------------------
				$password_reset = DB::table("password_resets")
				->select("*")->addSelect("password_resets.id")->where("password_resets.id",$id)->first();
            return view("password_reset.show", compact("password_reset"));
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
            $password_reset = PasswordReset::findOrFail($id);
    
            return view("password_reset.edit", compact("password_reset"));
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
				"email" => "required", //string('email')
				"token" => "required", //string('token')

            ]);
            $requestData = $request->all();
            
            $password_reset = PasswordReset::findOrFail($id);
            $password_reset->update($requestData);
    
            return redirect("password_reset")->with("flash_message", "password_reset updated!");
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
            PasswordReset::destroy($id);
    
            return redirect("password_reset")->with("flash_message", "password_reset deleted!");
        }
    }
    //=======================================================================
    
    