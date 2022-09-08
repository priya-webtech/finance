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
class StudentDetail extends Model
{


    public $table = 'student_detail';




    public $fillable = [
        'student_id',
        'course_id',
        'lead_source_id',
        'reg_taken_id',
        'branch_id',
        'agreed_amount',
        'reg_for_month',
        'due_date',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'student_id' => 'integer',
        'course_id' => 'integer',
        'lead_source_id' => 'integer',
        'reg_taken_id' => 'integer',
        'branch_id' => 'integer',
        'agreed_amount' => 'decimal:2',
        'reg_for_month' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'course_id' => 'required',
        'lead_source_id' => 'required',
        'reg_taken_id' => 'required',
        'branch_id' => 'required',
        'agreed_amount' => 'required',
        'reg_for_month' => 'required',
    ];

    public function leadSource(){
        return $this->belongsTo(LeadSources::class,'lead_source_id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'reg_taken_id');
    }
    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }


    public function getDuePaymentAttribute()
    {
     //$total =  Income::where('student_id',$this->id)->select(DB::raw('sum(paying_amount * gst) as total'));
     $total =  Income::where('student_id',$this->id)->sum('paying_amount', '+', 'gst');
     $remain = $this->agreed_amount - $total;
     return $remain;
    }

    public function studBatchDetail(){
        return $this->hasMany(StudentBatchDetail::class,'student_detail_id');
    }
    public function studFeesColl(){
        return $this->hasOne(StudentFessCollection::class,'student_detail_id');
    }
    public function StudentCoruseWisePayment(){
        return $this->hasMany(StudentFessCollection::class,'student_id','student_id');
    }
}
