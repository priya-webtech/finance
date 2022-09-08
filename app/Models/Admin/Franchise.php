<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class Franchise
 * @package App\Models\Admin
 * @version June 27, 2022, 10:26 am UTC
 *
 * @property string $title
 * @property integer $status
 */
class Franchise extends Model
{


    public $table = 'franchises';




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

    public function franchiseIncome()
    {
        return $this->hasOne(Income::class,'franchises_id');
    }

}
