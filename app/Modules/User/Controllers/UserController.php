<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use URL;
use Hash;
use Response;
use JWTAuth;
use JWTAuthException;
#use MailHelper;
#use GlobalHelper;
#use StatusHelper;
#use ResourceHelper;
#use \Carbon\Carbon;
#use ParameterHelper;
use App\Modules\User\Models\User;
use App\Modules\User\Models\Permission;
use App\Modules\User\Models\Role;
#use App\Modules\User\Libraries\UserHelper;
#use App\Modules\User\Libraries\UserParser;
#use App\Modules\User\Libraries\AuthHelper;
#use App\Modules\User\Requests\RegisterUserRequest;

class UserController extends Controller
{
	private $user;
    public function __construct(User $user)
	{
        $this->user = $user;
		//$user = JWTAuth::parseToken()->authenticate();
		//$user = JWTAuth::parseToken()->
    }
	public static function showAll()
	{	
		// Retrieve all the users in the database and return them
		$users = User::all();
		//return $users;
		//return response()->json(['status'=>true,'message'=>'User List','users'=>$users]);
        //return response()->json(['users'=>User::all()]);
        return response()->json(['data'=>$users]);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
