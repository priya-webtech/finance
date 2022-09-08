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
        'course_id',
        'gst',
        'income_id',
        'corporate_detail_id',
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
        'course_id' => 'integer',
        'corporate_detail_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'corporate_id' => 'required',
        'income_id' => 'required',
        'course_id'  => 'required',
    ];
    public function corporate(){
        return $this->belongsTo(Corporate::class,'corporate_id');
    }
    public function getIncome(){
        return $this->belongsTo(Income::class,'income_id');
    }
    public function corporateDetail(){
        return $this->belongsTo(CorporateDetail::class,'corporate_detail_id');
    }
}
