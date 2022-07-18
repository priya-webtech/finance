<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Staticdata;
use App\Repositories\BaseRepository;

/**
 * Class StaticdataRepository
 * @package App\Repositories\Admin
 * @version June 23, 2022, 3:51 pm UTC
*/

class StaticdataRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key_lable',
        'value_lable',
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
        return Staticdata::class;
    }
}
