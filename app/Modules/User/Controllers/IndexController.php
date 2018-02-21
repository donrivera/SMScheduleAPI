<?php

namespace App\Modules\User\Controllers;
use App\Http\Controllers\Controller;
#use App\Modules\ModuleOne\Models\TestModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index()
	{
		echo "Modular Approach...";
		// ModuleOne is the module name and dummy is the blade file
		// you can specify ModuleOne::someFolder.file if your file exists
		// inside a folder. Also the blade will use the same syntax i.e.
		// ModuleName::viewName
		//return view('ModuleOne::dummy');
		
	}
}
