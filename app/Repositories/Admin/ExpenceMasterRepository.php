<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ExpenceMaster;
use App\Repositories\BaseRepository;

/**
 * Class ExpenceMasterRepository
 * @package App\Repositories\Admin
 * @version July 2, 2022, 11:11 am UTC
*/

class ExpenceMasterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'expence_type_id',
        'branch_id',
        'bank_ac_id',
        'amount',
        'date',
        'remark'
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
        return ExpenceMaster::class;
    }
}
