<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\Student;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class StudentDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')
            ->editColumn('branch_id', function ($record){
                return $record->branch->title;
            })
            ->editColumn('student_type', function ($record){
                return $record->studentType->title;
            })
            ->editColumn('enquiry_type', function ($record){
                return $record->enquiryType->title;
            })
            ->editColumn('status', function ($record){
                if ($record->status == 1){
                  $status = "<span class='badge badge-success'>Active</span>";
                }else{
                    $status = "<span class='badge badge-danger'>Block</span>";
                }
                return $status;
            })
            ->filter(function ($record){
                $record->where(function ($q) {
                    if (request('enquiry_type')) {
                     $q->where('enquiry_type', request('enquiry_type'));
                    }
                    if (request('student_type')) {
                        $q->where('student_type', request('student_type'));
                    }
                    if (request('state')){
                        $q->where('state', request('state'));
                    }
                    if (request('dates')){
                        $part = explode("-",request('dates'));
                        $start = date('Y-m-d', strtotime($part[0]));
                        $end = date('Y-m-d', strtotime($part[1]));
                            $q->whereDate('created_at', '>=', $start)
                                ->whereDate('created_at', '<=', $end);
                    }
                });
               if (request('status')){
                   if (request('status') == 'assigned'){
                       $record->whereHas('studDetail', function($q) {
                           $q->whereHas('studBatchDetail');
                       });
                   }elseif (request('status') == 'unassigned'){

                       $record->whereHas('studDetail', function($q) {
                           $q->doesntHave('studBatchDetail');

                       });
                   }
               }
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student $model)
    {

        return  $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom' => 'Bfrtip',
                'stateSave' => true,
                'order' => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['searchable' => false],
            'name',
            'email',
            'mobile_no',
            'student_type',
            'enquiry_type',
            'branch_id',
            'state',
            'status',
            'branch_id',
            'remark',
            //'type' => ['searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'students_datatable_' . time();
    }
}
