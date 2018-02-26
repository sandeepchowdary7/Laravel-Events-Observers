<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all()->take(5);
    
        $result = [];
       foreach ($students as $student) {
         $result [] = $this->ResultFormatter($student);
       }
       return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     */
    public function store()
    {
        $student = new student;

        $student->name = Input::get('name');
        $student->age = Input::get('age');
        $student->qualification = Input::get('qualification');

        if (DB::table('students')->where('name', '=', Input::get('name'))->first()) {
             return "Already record found with the name " . Input::get('name');
            } 
        $student->save();
        return "Record saved with the name of " . Input::get('name');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student = Student::where('id', '=', $student->id)->first();

        $result = $this->ResultFormatter($student);
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $input = Input::all();

        $student->name = Input::get('name');
        $student->age = Input::get('age');
        $student->qualification = Input::get('qualification');

        $student->save();

        return $this->ResultFormatter($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
         $student = Student::where('id', '=', $student->id)->first();

        $student->delete();
        return "Record deleted with this associated id " . $student->id . " name " . $student->name;
    }

     protected function ResultFormatter($student)
    {
        return [
            'Student' => [
            'id' => $student->id,
            'name' => $student->name,
            'age' => $student->age,
            'qualification' => $student->qualification,
            'created at' => (string)$student->created_at,
            'updated at' => (string)$student->updated_at,
            ]
        ];
    }
}
