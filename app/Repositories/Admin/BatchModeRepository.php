<?php

namespace App\Repositories\Admin;

use App\Models\Admin\BatchMode;
use App\Repositories\BaseRepository;

/**
 * Class BatchModeRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 10:42 am UTC
*/

class BatchModeRepository extends BaseRepository
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
        return BatchMode::class;
    }
}
