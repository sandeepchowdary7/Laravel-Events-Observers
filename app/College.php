<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public $timestamps = TRUE;
	protected $table = 'colleges';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'college_code',
	];

	public static $rules = [
		'name'  => 'required',
		'college_code'  => 'required|max:7',
	];

	/**
     * Get the phone record associated with the user.
     */
	public function enrollment()
	{
		return $this->hasOne(Enrollment::class);
	}
}
