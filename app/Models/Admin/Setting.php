<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class Setting
 * @package App\Models\Admin
 * @version June 29, 2022, 11:50 am UTC
 *
 * @property string $app_logo
 * @property string $app_title
 * @property number $gst_per
 * @property number $tds_per
 * @property string $email
 * @property string $website
 * @property string $phone_1
 * @property string $phone_2
 * @property string $gst_no
 */
class Setting extends Model
{


    public $table = 'settings';
    public $timestamps = false;



    public $fillable = [
        'app_logo',
        'app_title',
        'gst_per',
        'tds_per',
        'email',
        'website',
        'phone_1',
        'phone_2',
        'gst_no'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'app_logo' => 'string',
        'app_title' => 'string',
        'gst_per' => 'decimal:2',
        'tds_per' => 'decimal:2',
        'email' => 'string',
        'website' => 'string',
        'phone_1' => 'string',
        'phone_2' => 'string',
        'gst_no' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'app_logo' => 'required',
        'app_title' => 'required',
        'gst_per' => 'required|numeric',
        'tds_per' => 'required|numeric',
        'email' => 'required',
        'website' => 'required',
        'phone_1' => 'required|digits:10',
        'phone_2' => 'required|digits:10',
        'gst_no' => 'required'
    ];


}
