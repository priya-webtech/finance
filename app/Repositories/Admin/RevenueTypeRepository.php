<?php

namespace App\Repositories\Admin;

use App\Models\Admin\RevenueType;
use App\Repositories\BaseRepository;

/**
 * Class RevenueTypeRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 10:35 am UTC
*/

class RevenueTypeRepository extends BaseRepository
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
        return RevenueType::class;
    }
}
