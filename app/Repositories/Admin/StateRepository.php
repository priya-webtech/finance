<?php

namespace App\Repositories\Admin;

use App\Models\Admin\State;
use App\Repositories\BaseRepository;

/**
 * Class StateRepository
 * @package App\Repositories\Admin
 * @version June 23, 2022, 1:59 pm UTC
*/

class StateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'state_name',
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
        return State::class;
    }
}
