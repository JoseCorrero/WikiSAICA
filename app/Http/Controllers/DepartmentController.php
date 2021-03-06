<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{

	public function index()
    {
        
    }

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $articles = DB::table('articles')->where('allowed', 'true')->where('department_id', $id)->orderBy('created_at', 'desc')->get();
        $deparment = DB::table('departments')->where('id',$id)->first();

        $title = $deparment->name;
        return view('articles.index', compact('articles','title'));
    }
}
