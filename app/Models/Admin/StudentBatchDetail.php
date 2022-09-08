<?php

namespace App\Models\Admin;

use App\Models\User;
use Eloquent as Model;
use Illuminate\Support\Facades\DB;


/**
 * Class Student
 * @package App\Models\Admin
 * @version June 27, 2022, 11:33 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $mobile_no
 * @property integer $lead_source
 * @property integer $enquiry_type
 * @property integer $student_type
 * @property string $state
 * @property number $agreed_amount
 * @property string $placement
 * @property integer $status
 */
class StudentBatchDetail extends Model
{


    public $table = 'student_batch_detail';




    public $fillable = [
        'student_detail_id',
        'trainer_id',
        'batch_id',
        'trainer_fees'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'student_detail_id' => 'integer',
//        'trainer_id' => 'json',
        'batch_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'trainer_id' => 'required',
        'batch_id' => 'required',
    ];


    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id');
    }
    public function StudDetail(){
        return $this->belongsTo(StudentDetail::class,'student_detail_id');
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class,'trainer_id');
    }
    public function batchTrainerDetail(){
        return $this->hasMany(BatchTrainerDetail::class,'student_batch_detail_id');
    }
}