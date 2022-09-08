<?php

namespace App\Repositories\Admin;

use App\Models\Admin\BatchType;
use App\Repositories\BaseRepository;

/**
 * Class BatchTypeRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 10:33 am UTC
*/

class BatchTypeRepository extends BaseRepository
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
        return BatchType::class;
    }
}
