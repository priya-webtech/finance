<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class Course
 * @package App\Models\Admin
 * @version June 27, 2022, 1:07 pm UTC
 *
 * @property string $course_name
 * @property string $description
 * @property integer $status
 */
class Course extends Model
{


    public $table = 'courses';




    public $fillable = [
        'course_name',
        'description',
        'status',
        'branch_id',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_name' => 'string',
        'description' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_name' => 'required',
        'branch_id' => 'required',
    ];


}
