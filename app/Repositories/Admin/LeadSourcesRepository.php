<?php

namespace App\Repositories\Admin;

use App\Models\Admin\LeadSources;
use App\Repositories\BaseRepository;

/**
 * Class LeadSourcesRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 9:46 am UTC
*/

class LeadSourcesRepository extends BaseRepository
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
        return LeadSources::class;
    }
}
