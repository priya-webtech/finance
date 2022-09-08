<?php

namespace App\Repositories\Admin;

use App\Models\Admin\TrainerFreeSlab;
use App\Repositories\BaseRepository;

/**
 * Class TrainerFreeSlabRepository
 * @package App\Repositories\Admin
 * @version June 30, 2022, 5:00 am UTC
*/

class TrainerFreeSlabRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trainer_id',
        'min_std',
        'max_std',
        'fees'
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
        return TrainerFreeSlab::class;
    }
}
