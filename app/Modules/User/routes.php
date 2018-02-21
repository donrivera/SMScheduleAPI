<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function (){return view('index');});

Route::group(['namespace' => 'App\Modules\User\Controllers', 'prefix' => 'api'], function () 
{
	Route::resource('authenticate', 'AuthController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthController@authenticate');
	Route::get('authenticate/user', 'AuthController@getAuthenticatedUser');
	Route::get('logout', 'AuthController@logOut');
	// Route to create a new role
	Route::post('role', 'AuthController@createRole');
	// Route to create a new permission
	Route::post('permission', 'AuthController@createPermission');
	// Route to assign role to user
	Route::post('assign-role', 'AuthController@assignRole');
	// Route to attache permission to a role
	Route::post('attach-permission', 'AuthController@attachPermission');
	//Route with JWT Authentication
	Route::group(['middleware' => ['jwt.auth','ability:admin,create-users']], function () 
	{
		
		Route::get('user', 'UserController@showAll');
		//Route::get('user-all', 'AuthController@showAll');
		
	});
	
});