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
class Corporate extends Model
{


    public $table = 'corporates';




    public $fillable = [
        'company_name',
        'contact_no',
        'email',
        'web_site',
        'address',
        'state',
        'city',
        'status',
        'branch_id',
        'batch_id',
        'trainer_amount',
        'agreed_amount',
        'gst_amount',
        'reg_for_month',
        'remark',
        'enquiry_type_id',
        'lead_source_id',
        'trainer_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'company_name' => 'string',
        'contact_no' => 'string',
        'email' => 'string',
        'web_site' => 'string',
        'address' => 'string',
        'state' => 'string',
        'city' => 'string',
        'status' => 'integer',
        'branch_id' => 'integer',
        'batch_id' => 'integer',
        'trainer_amount' => 'decimal:2',
        'agreed_amount' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'reg_for_month' => 'string',
        'remark' => 'string',
        'enquiry_type_id' => 'integer',
        'lead_source_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_name' => 'required',
        'contact_no' => 'required',
        'email' => 'required',
        'web_site' => 'nullable',
        'address' => 'nullable',
        'state' => 'required',
        'city' => 'required',
        'branch_id' => 'required',
        'batch_id' => 'required',
        'enquiry_type_id' => 'required',
        'lead_source_id' => 'required',
        'trainer_amount' => 'required',
        'agreed_amount' => 'required',
//        'gst_amount' => 'required',
        'reg_for_month' => 'required',
        'remark' => 'nullable',

    ];

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function enquiry(){
        return $this->belongsTo(EnquiryType::class,'enquiry_type_id');
    }
    public function lead(){
        return $this->belongsTo(LeadSources::class,'lead_source_id');
    }
    public function corporateDetail(){
        return $this->hasMany(CorporateDetail::class,'corporate_id');
    }
}
