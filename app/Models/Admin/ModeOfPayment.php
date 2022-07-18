<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class ModeOfPayment
 * @package App\Models\Admin
 * @version June 27, 2022, 10:30 am UTC
 *
 * @property string $title
 * @property integer $status
 */
class ModeOfPayment extends Model
{


    public $table = 'mode_of_payments';




    public $fillable = [
        'title',
        'status',
        'name',
        'ifsc_code',
        'account_no',
        'other_detail',
        'opening_balance',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'status' => 'integer',
        'name' => 'string',
        'ifsc_code' => 'string',
        'account_no'=> 'integer',
        'other_detail' => 'string',
//        'opening_balance' => 'decimal',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'name' => 'required',
        'ifsc_code' => 'required',
        'account_no' => 'required',
        'other_detail' => 'required',
        'opening_balance' => 'required',
    ];


}
