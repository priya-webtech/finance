<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Setting;
use App\Repositories\BaseRepository;

/**
 * Class SettingRepository
 * @package App\Repositories\Admin
 * @version June 29, 2022, 11:50 am UTC
*/

class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'app_logo',
        'app_title',
        'gst_per',
        'tds_per',
        'email',
        'website',
        'phone_1',
        'phone_2',
        'gst_no'
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
        return Setting::class;
    }
}
