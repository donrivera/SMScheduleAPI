<?php

namespace App\Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Foundation\Auth\User as Authenticatable;

class Course extends Model //implements AuthenticatableContract
{
    //use Authenticatable;
	#use SoftDeletes;

    /**
     * The primary key of table.
     *
     * @var string
     */
    protected $primaryKey = 'course_id';

    /**
     * Table name
     * @var string
     */
    protected $table = 'courses';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token',];
}
