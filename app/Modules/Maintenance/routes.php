<?php

/*
|--------------------------------------------------------------------------
|  Module Routes
|--------------------------------------------------------------------------
*/
Route::group([
				'middleware' => ['jwt.auth','ability:admin,create-users'],
				'namespace' => 'App\Modules\Maintenance\Controllers', 
				'prefix' => 'api/maintenance'], 
	function () 
	{
		
		#Course Controller Routes#
		Route::resource('course', 'CourseController');
		
		#Center Routes#
		#Center Vacation#
		#Course Fee#
		#Grade#
		#Group Size#
		#Center Group Size#
		#Center Room#
		#Teacher Status#
		#Student Status#
		#School Week#
		#Alert Type#
		#Group Type#
		#Payment Type#
		#Material Type#
		#Units#
		#Lead Type#
	});