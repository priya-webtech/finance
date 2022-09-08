<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ExpenseTypes;
use App\Repositories\BaseRepository;

/**
 * Class Expense TypesRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 9:53 am UTC
*/

class ExpenseTypesRepository extends BaseRepository
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
        return ExpenseTypes::class;
    }
}
