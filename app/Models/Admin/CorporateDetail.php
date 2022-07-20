<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class Corporate
 * @package App\Models\Admin
 * @version June 30, 2022, 11:57 am UTC
 *
 * @property string $company_name
 * @property string $contact_no
 * @property string $email
 * @property string $web_site
 * @property string $address
 * @property string $state
 * @property string $city
 * @property integer $status
 * @property integer $branch_id
 * @property integer $batch_id
 * @property number $trainer_amount
 * @property number $agreed_amount
 * @property number $gst_amount
 * @property string $reg_for_month
 * @property string $remark
 * @property integer $enquiry_type_id
 * @property integer $lead_source_id
 */
class CorporateDetail extends Model
{


    public $table = 'corporate_detail';




    public $fillable = [
        'corporate_id',
        'course_id',
        'reg_taken_id',
        'agreed_amount',
        'placement',
        'reg_for_month'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'corporate_id' => 'integer',
        'course_id' => 'integer',
        'reg_taken_id' => 'integer',
        'agreed_amount' => 'decimal:2',
        'placement' => 'string',
        'reg_for_month' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'corporate_id' => 'required',
        'course_id' => 'required',
        'reg_taken_id' => 'required',
        'agreed_amount' => 'required',
        'placement' => 'required',
        'reg_for_month' => 'required',
    ];


    public function corporateBatchDetail(){
        return $this->hasMany(CorporateBatchDetail::class,'corporate_detail_id');
    }
    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
}
