<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Franchise;
use App\Repositories\BaseRepository;

/**
 * Class FranchiseRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 10:26 am UTC
*/

class FranchiseRepository extends BaseRepository
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
        return Franchise::class;
    }
}
