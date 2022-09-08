<?php

namespace App\Repositories\Admin;

use App\Models\Admin\StudentType;
use App\Repositories\BaseRepository;

/**
 * Class StudentTypeRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 10:22 am UTC
*/

class StudentTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
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
        return StudentType::class;
    }
}
