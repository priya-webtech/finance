<?php

namespace App\Models\Admin;

use Eloquent as Model;



/**
 * Class TrainerFreeSlab
 * @package App\Models\Admin
 * @version June 30, 2022, 5:00 am UTC
 *
 * @property integer $trainer_id
 * @property integer $min_std
 * @property integer $max_std
 * @property number $fees
 */
class TrainerFreeSlab extends Model
{


    public $table = 'trainer_free_slabs';




    public $fillable = [
        'trainer_id',
        'min_std',
        'max_std',
        'fees'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trainer_id' => 'integer',
        'min_std' => 'integer',
        'max_std' => 'integer',
        'fees' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trainer_id' => 'required',
        'min_std' => 'required|numeric',
        'max_std' => 'required|numeric',
        'fees' => 'required|numeric'
    ];

    public function trainer(){
        return $this->belongsTo(Trainer::class,'trainer_id');
    }
}
