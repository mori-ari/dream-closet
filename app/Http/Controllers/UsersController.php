<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Auth;
use Validate;
use DB;
use App\User;
    
    //=======================================================================
    class UsersController extends Controller
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
				// -- QueryBuilder: SELECT [users]--
				// ----------------------------------------------------
				$user = DB::table("users")
				->orWhere("users.name", "LIKE", "%$keyword%")->orWhere("users.email", "LIKE", "%$keyword%")->orWhere("users.email_verified_at", "LIKE", "%$keyword%")->orWhere("users.password", "LIKE", "%$keyword%")->orWhere("users.remember_token", "LIKE", "%$keyword%")->select("*")->addSelect("users.id")->paginate($perPage);
            } else {
                    //$user = User::paginate($perPage);
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [users]--
				// ----------------------------------------------------
				$user = DB::table("users")
				->select("*")->addSelect("users.id")->paginate($perPage);              
            }          
            return view("user.index", compact("user"));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\View\View
         */
        public function create()
        {
            return view("user.create");
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
				"name" => "required", //string('name')
				"email" => "required", //string('email')
				"email_verified_at" => "nullable|date_format:Y-m-d H:i:s", //timestamp('email_verified_at')->nullable()
				"password" => "required", //string('password')
				"remember_token" => "required|max:100", //string('remember_token',100)

            ]);
            $requestData = $request->all();
            
            User::create($requestData);
    
            return redirect("user")->with("flash_message", "user added!");
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
            //$user = User::findOrFail($id);
            
				// ----------------------------------------------------
				// -- QueryBuilder: SELECT [users]--
				// ----------------------------------------------------
				$user = DB::table("users")
				->select("*")->addSelect("users.id")->where("users.id",$id)->first();
            return view("user.show", compact("user"));
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
            $user = User::findOrFail($id);
    
            return view("user.edit", compact("user"));
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
				"name" => "required", //string('name')
				"email" => "required", //string('email')
				"email_verified_at" => "nullable|date_format:Y-m-d H:i:s", //timestamp('email_verified_at')->nullable()
				"password" => "required", //string('password')
				"remember_token" => "required|max:100", //string('remember_token',100)

            ]);
            $requestData = $request->all();
            
            $user = User::findOrFail($id);
            $user->update($requestData);
    
            return redirect("user")->with("flash_message", "user updated!");
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
            User::destroy($id);
    
            return redirect("user")->with("flash_message", "user deleted!");
        }
    }
    //=======================================================================
    
    