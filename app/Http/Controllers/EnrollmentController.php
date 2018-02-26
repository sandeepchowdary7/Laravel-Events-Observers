<?php

namespace App\Http\Controllers;

use App\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::all()->take(5);

        $result = [];
        foreach ($enrollments as $enrollment) {
           $result [] = $this->ResultFormatter($enrollment);
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
       $enrollment = new Enrollment;

       $enrollment->college_code = Input::get('college_code');
       $enrollment->college_name = Input::get('college_name');

       if(DB::table('enrollments')->where('college_code', '=', Input::get('college_code'))->first()){
        return "This college was Enrolled with this id " . Input::get('college_code');
       }

       $enrollment->save();
       return "Enrollment has been done with " . Input::get('college_code');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        $enrollment = Enrollment::where('id', '=', $enrollment->id)->first();

        $result = $this->ResultFormatter($enrollment);
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $input = Input::all();

        $enrollment->college_code = Input::get('college_code');
        $enrollment->college_name = Input::get('college_name');

        $enrollment->save();
        return $this->ResultFormatter($enrollment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment = Enrollment::where('id', '=', $enrollment->id)->first();

        $enrollment->delete();
        return "Enrollment has been deleted with this " . Input::get('college_code');
    }

    protected function ResultFormatter($enrollment)
    {
        return [
            'Enrollment' => [
                'id' => $enrollment->id,
                'College Code' => $enrollment->college_code,
                'College Name' => $enrollment->college_name,
                'Enrolled at' => (string)$enrollment->created_at,
                'Updated at' => (string)$enrollment->updated_at
            ]
        ];
    }
}
