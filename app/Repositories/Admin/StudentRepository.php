<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Student;
use App\Repositories\BaseRepository;

/**
 * Class StudentRepository
 * @package App\Repositories\Admin
 * @version June 27, 2022, 11:33 am UTC
*/

class StudentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'mobile_no',
        'lead_source',
        'enquiry_type',
        'student_type',
        'state',
        'agreed_amount',
        'placement',
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
        return Student::class;
    }
}
