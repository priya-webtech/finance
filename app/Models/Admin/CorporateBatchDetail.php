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
class CorporateBatchDetail extends Model
{


    public $table = 'corporate_batch_details';




    public $fillable = [
        'corporate_detail_id',
        'batch_id',
        'trainer_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'corporate_detail_id' => 'integer',
        'batch_id' => 'integer',
        'trainer_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'batch_id' => 'required',
        'trainer_id' => 'required',
    ];

    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id');
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class,'trainer_id');
    }
    public function corporateBatchDetail(){
        return $this->hasMany(CorporateDetail::class,'corporate_id');
    }
}
