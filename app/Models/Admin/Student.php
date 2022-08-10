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
class Student extends Model
{


    public $table = 'students';




    public $fillable = [
        'name',
        'email',
        'mobile_no',
        'student_type',
        'enquiry_type',
        'branch_id',
        'state',
        'status',
        'branch_id',
        'lead_source_id',
        'remark',
        'due_date',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'mobile_no' => 'string',
        'lead_source_id' => 'integer',
        'enquiry_type' => 'integer',
        'student_type' => 'integer',
        'branch_id' => 'integer',
        'state' => 'string',
        // 'agreed_amount' => 'decimal:2',
        // 'placement' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'mobile_no' => 'required|digits:10',
        // 'lead_source_id' => 'required',
        'enquiry_type' => 'required',
        'student_type' => 'required',
        'state' => 'required',
        'branch_id' => 'required',
        //  'agreed_amount' => 'required',
        // 'placement' => 'required',
        // 'branch_id' => 'required',
        // 'batch_id' => 'required',
        // 'reg_for_month' => 'required',
        // 'reg_taken_id' => 'required',
    ];

    public function leadSource(){
        return $this->belongsTo(LeadSources::class,'lead_source_id');
    }
    public function enquiryType(){
        return $this->belongsTo(EnquiryType::class,'enquiry_type');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function studentType(){
        return $this->belongsTo(StudentType::class,'student_type');
    }
    public function StudentIncome(){
        return $this->hasMany(StudentFessCollection::class,'student_id');
    }

    public function getDuePaymentAttribute()
    {
        //$total =  Income::where('student_id',$this->id)->select(DB::raw('sum(paying_amount * gst) as total'));
        $total =  Income::where('student_id',$this->id)->sum('paying_amount', '+', 'gst');
        $remain = $this->agreed_amount - $total;
        return $remain;
    }

    public function studDetail(){
        return $this->hasMany(StudentDetail::class,'student_id');
    }
    public function studFeesCollection(){
        return $this->hasMany(StudentFessCollection::class,'student_id');
    }
}
