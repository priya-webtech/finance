<?php

namespace App\Models\Admin;

use App\Models\User;
use Eloquent as Model;



/**
 * Class Income
 * @package App\Models\Admin
 * @version June 28, 2022, 8:05 am UTC
 *
 * @property integer $income_type_id
 * @property integer $student_id
 * @property integer $course_id
 * @property integer $batch_id
 * @property string $trainer_name
 * @property number $paying _amount
 * @property integer $gst
 * @property string $register_date
 * @property integer $registration_taken_by
 * @property string $comment
 * @property integer $status
 */
class Income extends Model
{


    public $table = 'incomes';




    public $fillable = [
        'income_type_id',
        'branch_id',
        'bank_acc_id',
        'course_id',
        'trainer_name',
        'paying_amount',
        'register_date',
        'registration_taken_by',
        'comment',
        'status',
        'franchises_id',
        'gst',
        'mode_of_payment',
        'student_id',
        'corporate_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'income_type_id' => 'integer',
        'course_id' => 'integer',
        'batch_id' => 'integer',
        'trainer_name' => 'string',
        'paying_amount' => 'decimal:2',
        'register_date' => 'string',
        'registration_taken_by' => 'integer',
        'comment' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'income_type_id' => 'required',
//        'paying_amount' => 'required',
//        'register_date' => 'required',
//        'mode_of_payment' => 'required',
        'branch_id' => 'required',
    ];

    public function incomeStudFees()
    {
        return $this->hasOne(StudentFessCollection::class,'income_id');
    }
    public function incomeStudFeesGet()
    {
        return $this->hasMany(StudentFessCollection::class,'income_id');
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class,'trainer_name');
    }
    public function incomeCorpo()
    {
        return $this->belongsTo(Corporate::class,'corporate_id');
    }
    public function incomeStud()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function incomeType(){
        return $this->belongsTo(IncomeType::class,'income_type_id');
    }
    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function bankAcc(){
        return $this->belongsTo(BankAccount::class,'bank_acc_id');
    }
    public function registration_take(){
        return $this->belongsTo(User::class,'registration_taken_by');
    }
    public function corporateStudFees()
    {
        return $this->hasOne(CorporateFessCollection::class,'income_id');
    }
}
