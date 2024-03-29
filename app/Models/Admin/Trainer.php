<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class Trainer
 * @package App\Models\Admin
 * @version June 28, 2022, 4:52 am UTC
 *
 * @property string $trainer_name
 * @property string $email
 * @property integer $status
 */
class Trainer extends Model
{


    public $table = 'trainers';




    public $fillable = [
        'trainer_name',
        'status',
        'branch_id',
        'course_id',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trainer_name' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trainer_name' => 'required',
         'branch_id'  => 'required',
         'course_id'  => 'required',
    ];

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function courseWiseTrainerFee()
    {
        return $this->hasMany(StudentDetail::class,'course_id','course_id');
    }
}
