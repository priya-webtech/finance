<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class StudentType
 * @package App\Models\Admin
 * @version June 27, 2022, 10:22 am UTC
 *
 * @property string $title
 * @property integer $status
 */
class StudentFessCollection extends Model
{


    public $table = 'student_fees_collections';




    public $fillable = [
        'student_id',
        'income_id',
        'gst',
        'course_id',
        'student_detail_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'student_id' => 'string',
        'income_id' => 'integer',
        'course_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'income_id' => 'required',
        'course_id'  => 'required',
    ];
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
    public function getIncome(){
        return $this->belongsTo(Income::class,'income_id');
    }
    public function studentDetail(){
        return $this->belongsTo(StudentDetail::class,'student_detail_id');
    }
}
