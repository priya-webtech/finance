<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ModeOfPayment;
use App\Repositories\BaseRepository;

/**
 * Class ModeOfPaymentRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 10:30 am UTC
*/

class ModeOfPaymentRepository extends BaseRepository
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
        return ModeOfPayment::class;
    }
}
