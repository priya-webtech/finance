<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class ExpenceMaster
 * @package App\Models\Admin
 * @version July 2, 2022, 11:11 am UTC
 *
 * @property integer $expence_type_id
 * @property integer $branch_id
 * @property integer $bank_ac_id
 * @property number $amount
 * @property string $date
 * @property string $remark
 */
class ExpenceMaster extends Model
{


    public $table = 'expence_masters';




    public $fillable = [
        'expence_type_id',
        'branch_id',
        'bank_ac_id',
        'amount',
        'date',
        'remark',
        'student_id',
        'batch_id',
        'trainer_id',
        'tds',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'expence_type_id' => 'integer',
        'branch_id' => 'integer',
        'bank_ac_id' => 'integer',
        'amount' => 'decimal:2',
        'date' => 'date',
        'remark' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'expence_type_id' => 'required',
        'branch_id' => 'required',
        'bank_ac_id' => 'required',
        'amount' => 'required',
    ];
    public function bankAcc(){
        return $this->belongsTo(ModeOfPayment::class,'bank_ac_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function expenceType(){
        return $this->belongsTo(ExpenseTypes::class,'expence_type_id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id');
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class,'trainer_id');
    }
}
