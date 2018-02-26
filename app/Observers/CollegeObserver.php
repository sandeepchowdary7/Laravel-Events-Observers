<?php

namespace App\Observer;

use App\Enrollment;
use App\College;
use DB;
use Illuminate\Support\Facades\Input;

class CollegeObserver
{
	/**
     * Create a college record when enrollment has been taken place.
     */
    public function creating(Enrollment $enrollment)
    {
       $input = Input::all();

       $college = new College;

       $college->name = Input::get('college_name');
       $college->code = Input::get('college_code');

       if(DB::table('colleges')->where('name', '=', Input::get('name'))->first()){
        return "College already enrolled with this name " . Input::get('name');
       }
       $college->save();
    }

    /**
     * Delete a college record when enrollment was deleted
     */
    public function deleting(Enrollment $enrollment)
    {
    	$college = DB::table('colleges')->where('code', '=', $enrollment->college_code)->first();
    	$enrollment = DB::table('enrollments')->where('id', '=', $enrollment->id)->where('college_code', '=', Input::get('college_code'))->first();

    	if($college == $enrollment) {
        return "Everything looks like ok";
       } else {
       	$college->delete();
       }
    }
}