<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    public $timestamps = TRUE;
	protected $table = 'enrollments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'college_code',
	];

	public static $rules = [
		'college_code'  => 'required|max:7',
		'college_name'  => 'required',
	];

	 /**
     * Get the phone record associated with the user.
     */
	public function college()
	{
		return $this->belongsTo(College::class, 'college_code');
	}
}
