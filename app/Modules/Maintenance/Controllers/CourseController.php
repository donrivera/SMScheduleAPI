<?php

namespace App\Modules\Maintenance\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Modules\Maintenance\Libraries\CourseHelper;

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
use App\Modules\Maintenance\Models\Course;
//use App\Modules\User\Models\User;
#use App\Modules\User\Libraries\UserHelper;
#use App\Modules\User\Libraries\UserParser;
#use App\Modules\User\Libraries\AuthHelper;
#use App\Modules\User\Requests\RegisterUserRequest;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	//private $user;
	private $course;
    public function __construct()
	{
        //$this->course = $course;
		$course = JWTAuth::parseToken()->authenticate();
		
    }
	public static function showAll()
	{	
		// Retrieve all the course in the database and return them
        $course = Course::all();
        $course_helper=CourseHelper::view();
		$response = [
						'code'      => '200',
						'status'    => 'AC200',
						'data'      => [$course,$course_helper], 
						'message'   => "Connection Ok"
					];
		return response()->json($response);
	}
    public function index()
    {
       // Retrieve all the course in the database and return them
        $course = Course::all();
        $course_helper=CourseHelper::view();
		$response = [
						'code'      => '200',
						'status'    => 'AC200',
                        'data'      => [$course,$course_helper], 
                        'message'   => "Connection Ok"
					];
		return response()->json($response);
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
        /*
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'nerd_level' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nerds/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $nerd = new Nerd;
            $nerd->name       = Input::get('name');
            $nerd->email      = Input::get('email');
            $nerd->nerd_level = Input::get('nerd_level');
            $nerd->save();

            // redirect
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to('nerds');
        }
        */
        
        $course = new Course;
        $course->name           = $request->get('name');
        $course->slno           = $request->get('slno');
        $course->code           = $request->get('code');
        $course->description    = $request->get('description');
        $course->fees           = $request->get('fees');
        $course->save();
        
        //dd($request->all());
        //echo $request->get('name');
        //$course=$request->all();
        //Course::create($course);
        //$course=
        $response = [
                        'code'      => '200',
                        'status'    => 'AC200',
                        'data'      => "Course Added", 
                        'message'   => "Connection Ok"
                    ];
        return Response::json($response);
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
      $course=Course::find($id);
      $response =   [
                        'code'      => '200',
                        'status'    => 'AC200',
                        'data'      => $course, 
                        'message'   => "Connection Ok"
                    ];
    return Response::json($response);
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
        /*
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'nerd_level' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nerds/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $nerd = Nerd::find($id);
            $nerd->name       = Input::get('name');
            $nerd->email      = Input::get('email');
            $nerd->nerd_level = Input::get('nerd_level');
            $nerd->save();
        */
        $course = Course::find($id);
        $course->name           = $request->get('name');
        $course->slno           = $request->get('slno');
        $course->code           = $request->get('code');
        $course->description    = $request->get('description');
        $course->fees           = $request->get('fees');
        $course->save();
        $response = [
            'code'      => '200',
            'status'    => 'AC200',
            'data'      => $course->name."Course Updated", 
            'message'   => "Connection Ok"
        ];
        return Response::json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        $response = [
            'code'      => '200',
            'status'    => 'AC200',
            'data'      => "Course Removed", 
            'message'   => "Connection Ok"
        ];
        return Response::json($response);
    }
}
