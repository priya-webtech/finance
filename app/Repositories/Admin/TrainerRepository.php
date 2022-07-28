<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Trainer;
use App\Repositories\BaseRepository;

/**
 * Class TrainerRepository
 * @package App\Repositories\Admin
 * @version June 28, 2022, 4:52 am UTC
*/

class TrainerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trainer_name',
        'email',
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
        return Trainer::class;
    }
}
