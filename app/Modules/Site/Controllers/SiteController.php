<?php

namespace App\Modules\Maintenance\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Modules\Site\Libraries\SiteHelper;

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
use App\Modules\Site\Models\Site;
//use App\Modules\User\Models\User;
#use App\Modules\User\Libraries\UserHelper;
#use App\Modules\User\Libraries\UserParser;
#use App\Modules\User\Libraries\AuthHelper;
#use App\Modules\User\Requests\RegisterUserRequest;

class SiteController extends Controller
{
    private $course;
    public function __construct()
	{
        //$this->course = $course;
		$course = JWTAuth::parseToken()->authenticate();
		
    }
    public function index()
    {
        // Retrieve all the site in the database and return them
        $site = Site::all();
        $site_helper=SiteHelper::view();
		$response = [
						'code'      => '200',
						'status'    => 'AC200',
                        'data'      => [$course,$course_helper], 
                        'message'   => "Connection Ok"
					];
		return response()->json($response);
    }
}
