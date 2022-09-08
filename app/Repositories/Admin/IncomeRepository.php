<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Income;
use App\Repositories\BaseRepository;

/**
 * Class IncomeRepository
 * @package App\Repositories\Admin
 * @version June 28, 2022, 8:05 am UTC
*/

class IncomeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'income_type_id',
        'student_id',
        'course_id',
        'batch_id',
        'trainer_name',
        'paying _amount',
        'gst',
        'register_date',
        'registration_taken_by',
        'comment',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Income::class;
    }
}
