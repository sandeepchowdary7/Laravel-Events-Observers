<?php

namespace App\Http\Controllers;

use App\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges = College::all()->take(5);

        $result = [];
        foreach ($colleges as $college) {
            $result [] = $this->ResultFormtter($college);
        }

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Find CollegeObserver for this method

        
       // $input = Input::all();

       // $college = new College;

       // $college->name = Input::get('name');
       // $college->code = Input::get('code');

       // if(DB::table('colleges')->where('name', '=', Input::get('name'))->first()){
       //  return "College already enrolled with this name " . Input::get('name');
       // }
       // $college->save();
       // return $this->ResultFormtter($college);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function show(College $college)
    {
        $college = College::where('id', '=', $college->id)->first();

        return $result = $this->ResultFormtter($college);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, College $college)
    {
        $input = Input::all();

        $college->name = Input::get('name');
        $college->code = Input::get('code');

        $college->save();
        return $this->ResultFormtter($college);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy(College $college)
    {
        $college = College::where('id', '=', $college->id)->delete();

        return "college has been deleted";
    }

    protected function ResultFormtter($college)
    {
        return [
            'College' => [
                'id' => $college->id,
                'name' => $college->name,
                'code' => $college->code,
                'created at' => (string)$college->created_at,
                'updated at' => (string)$college->updated_at
            ]
        ];
    }
}
