<?php

namespace App\Observer;

use App\Enrollment;
use App\College;
use DB;
use Illuminate\Support\Facades\Input;

class CollegeObserver
{
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
}