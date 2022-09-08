<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class Batch
 * @package App\Models\Admin
 * @version June 28, 2022, 5:17 am UTC
 *
 * @property integer $course_id
 * @property integer $batch_mode_id
 * @property integer $trainer_id
 * @property string $name
 * @property string $start
 * @property integer $status
 */
class Batch extends Model
{


    public $table = 'batches';




    public $fillable = [
        'course_id',
        'batch_mode_id',
        'trainer_id',
        'name',
        'start',
        'status',
        'batch_status',
        'batch_type_id',
        'trainer_payment_status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
        'batch_mode_id' => 'integer',
        'trainer_id' => 'integer',
        'name' => 'string',
        'start' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       'course_id' => 'required',
     //   'batch_mode_id' => 'required',
        'trainer_id' => 'required',
        'name' => 'required',
        'start' => 'required',
        'batch_type_id' => 'required',
//        'batch_status' => 'required'
    ];

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function batchMode(){
        return $this->belongsTo(BatchMode::class,'batch_mode_id');
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class,'trainer_id');
    }
    public function batchType(){
        return $this->belongsTo(BatchType::class,'batch_type_id');
    }
    public function assignBatch(){
        return $this->hasMany(StudentBatchDetail::class,'batch_id');
    }
    public function assignCorpoBatch(){
        return $this->hasMany(CorporateBatchDetail::class,'batch_id');
    }
}
