<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class StudentType
 * @package App\Models\Admin
 * @version June 27, 2022, 10:22 am UTC
 *
 * @property string $title
 * @property integer $status
 */
class CorporateFessCollection extends Model
{


    public $table = 'corporate_fees_collections';




    public $fillable = [
        'corporate_id',
        'batch_id',
        'gst',
        'income_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'corporate_id' => 'string',
        'income_id' => 'integer',
        'batch_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'corporate_id' => 'required',
        'income_id' => 'required',
        'batch_id'  => 'required',
    ];
    public function corporate(){
        return $this->belongsTo(Corporate::class,'corporate_id');
    }

}