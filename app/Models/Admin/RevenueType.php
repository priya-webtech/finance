<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class RevenueType
 * @package App\Models\Admin
 * @version June 27, 2022, 10:35 am UTC
 *
 * @property integer $title
 * @property integer $status
 */
class RevenueType extends Model
{


    public $table = 'revenue_types';




    public $fillable = [
        'title',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];


}
