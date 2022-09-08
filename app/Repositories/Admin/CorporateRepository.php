<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Corporate;
use App\Repositories\BaseRepository;

/**
 * Class CorporateRepository
 * @package App\Repositories\Admin
 * @version June 30, 2022, 11:57 am UTC
*/

class CorporateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'company_name',
        'contact_no',
        'email',
        'web_site',
        'address',
        'state',
        'city',
        'status',
        'branch_id',
        'batch_id',
        'trainer_amount',
        'agreed_amount',
        'gst_amount',
        'reg_for_month',
        'remark',
        'enquiry_type_id',
        'lead_source_id'
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
        return Corporate::class;
    }
}
