<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = TRUE;
	protected $table = 'students';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'age',
		'qualification',
	];

	public static $rules = [
		'name'  => 'required',
		'age' => 'required',
		'qualification' => 'required',
	];

	public function createdBy()
	{
		return $this->belongsTo(Student::class, 'created_by');
	}
}
