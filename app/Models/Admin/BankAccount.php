<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class BankAccount
 * @package App\Models\Admin
 * @version June 29, 2022, 12:33 pm UTC
 *
 * @property string $name
 * @property string $ifsc_code
 * @property string $account_no
 * @property string $other _detail
 * @property number $opening_balance
 * @property integer $status
 */
class BankAccount extends Model
{


    public $table = 'bank_accounts';




    public $fillable = [
        'name',
        'ifsc_code',
        'account_no',
        'other_detail',
        'opening_balance',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'ifsc_code' => 'string',
        'account_no' => 'string',
        'other_detail' => 'string',
       // 'opening_balance' => 'decimal:2',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'ifsc_code' => 'required',
        'account_no' => 'required',
        'opening_balance' => 'required'
    ];


}
