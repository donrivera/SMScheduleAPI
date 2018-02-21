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
use Log;
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
#edit vendor/zizaco/src/config/config.php update path for models for modular approach
class AuthController extends Controller
{

	/**
	 * @var Object/Collection
	 */
	private $auth;
	private $user;
    public function __construct(User $user)
	{
        $this->user = $user;
		$this->middleware('jwt.auth', ['except' => [
														'authenticate',
														'printUsers',
														'getAuthenticatedUser',
														'createPermission',
														'createRole',
														'assignRole',
														'attachPermission'
													]
										]
						);
    }
	public function getAuthenticatedUser()
	{
		try 
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) 
			{
				return response()->json(['user_not_found'], 404);
			}

		} 
		catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) 
		{
			return response()->json(['token_expired'], $e->getStatusCode());
		} 
		catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) 
		{
			return response()->json(['token_invalid'], $e->getStatusCode());
		} 
		catch (Tymon\JWTAuth\Exceptions\JWTException $e) 
		{
			return response()->json(['token_absent'], $e->getStatusCode());
		}
		// the token is valid and we have found the user via the sub claim
		return response()->json(compact('user'));
	}
	public function logOut(Request $request)
	{
		//JWTAuth::invalidate(JWTAuth::getToken());
		$this->validate($request, ['token' => 'required']);
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
	}
	public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) 
			{
                return response()->json(['error' => 'invalid_credentials','data'=>$credentials], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
	}
	public function createRole(Request $request)
	{
		$role = new Role();
		$existing_role = Role::where('name','=',$request->input('name'))->first();
		if(!$existing_role)
		{
			$role->name = $request->input('name');
			$role->save();
			return response()->json("Role Created");
		}
		else
		{
			return response()->json("Duplicate Role");
		}
    }

	public function createPermission(Request $request)
	{

		$permission = new Permission();
		$existing_permission = Permission::where('name','=',$request->input('name'))->first();
		if(!$existing_permission)
		{
			$permission->name = $request->input('name');
			$permission->save();
			return response()->json("Permission Created");
		}
		else
		{
			return response()->json("Duplicate Permission");
		}
		

    }

	public function assignRole(Request $request)
	{
        $user = User::where('email', '=', $request->input('email'))->first();
		//$role = new Role();
        $role = Role::where('name', '=', $request->input('role'))->first();
		$user->attachRole($role);
		//$user->attachRole($request->input('role'));
        //$user->roles()->attach($role->id);

		//return response()->json("Assigned Role Created");
		return response()->json([
									'code'		=> '200',
									'data'		=>	[
														'user'=>$user,
														'role'=>$role
													],
									'message'	=>'Assigned Role Created'
								]);
    }

	public function attachPermission(Request $request)
	{
        $role = Role::where('name', '=', $request->input('role'))->first();
        $permission = Permission::where('name', '=', $request->input('name'))->first();
        $role->attachPermission($permission);

        return response()->json([
			'code'		=> '200',
			'data'		=>	[
								'role'=>$role,
								'permission'=>$permission,

							],
			'message'	=>'Assigned Permission Created'
		]);
	}
    public static function showAllUser()
	{	
		// Retrieve all the users in the database and return them
		$users = User::all();
		//return $users;
		//return response()->json(['status'=>true,'message'=>'User List','users'=>$users]);
        //return response()->json(['users'=>User::all()]);
        return response()->json(['data'=>$users]);
	}
	
}
