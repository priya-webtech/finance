<?php

namespace App\Repositories\Admin;

use App\Models\Admin\EnquiryType;
use App\Repositories\BaseRepository;

/**
 * Class EnquiryTypeRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 10:06 am UTC
*/

class EnquiryTypeRepository extends BaseRepository
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
        return EnquiryType::class;
    }
}
