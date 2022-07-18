<?php

namespace App\Repositories\Admin;

use App\Models\Admin\BankAccount;
use App\Repositories\BaseRepository;

/**
 * Class BankAccountRepository
 * @package App\Repositories\Admin
 * @version June 29, 2022, 12:33 pm UTC
*/

class BankAccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'ifsc_code',
        'account_no',
        'other _detail',
        'opening_balance',
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
        return BankAccount::class;
    }
}
