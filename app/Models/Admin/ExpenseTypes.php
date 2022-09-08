<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;


/**
 * Class Expense Types
 * @package App\Models\Admin
 * @version June 27, 2022, 9:53 am UTC
 *
 * @property string $title
 * @property string $status
 */
class ExpenseTypes extends Model
{


    public $table = 'expense_types';




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
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    public function expense()
    {
        return $this->hasMany(ExpenceMaster::class,'expence_type_id');
    }
}
