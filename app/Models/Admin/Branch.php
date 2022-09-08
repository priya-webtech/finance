<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class Branch
 * @package App\Models\Admin
 * @version June 27, 2022, 10:28 am UTC
 *
 * @property string $title
 * @property integer $status
 */
class Branch extends Model
{


    public $table = 'branches';
    



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
