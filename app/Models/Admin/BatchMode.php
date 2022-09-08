<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class BatchMode
 * @package App\Models\Admin
 * @version June 27, 2022, 10:42 am UTC
 *
 * @property string $title
 * @property integer $status
 */
class BatchMode extends Model
{


    public $table = 'batch_modes';
    



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
