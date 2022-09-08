<?php

namespace App\Repositories\Admin;

use App\Models\Admin\IncomeType;
use App\Repositories\BaseRepository;

/**
 * Class IncomeTypeRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 10:19 am UTC
*/

class IncomeTypeRepository extends BaseRepository
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
        return IncomeType::class;
    }
}
