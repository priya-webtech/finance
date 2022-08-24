<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Batch;
use App\Models\Admin\Carcompany;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\Student;
use App\Models\Admin\StudentFessCollection;
use App\Models\Admin\Trainer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class BatchDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')
            ->editColumn('course_id', function ($record){
                return $record->course->course_name;
            })
            ->editColumn('batch_mode_id', function ($record){
                return $record->batchMode->title;
            })
            ->editColumn('trainer_id', function ($record){
                return $record->trainer->trainer_name;
            })
            ->editColumn('batch_status', function ($record) {
                if ($record->batch_status == 'open'){
                    $status = "<span class='badge badge-success'>OPEN</span>";
                }else{
                    $status = "<span class='badge badge-danger'>Closed</span>";
                }
                return $status;
            })
            ->editColumn('batch_type_id', function ($record) {
                return $record->batchType->title;
            })

            ->filter(function ($record){
                $record->where(function ($q) {
                    if (request('dates')){
                        $part = explode("-",request('dates'));
                        $start = date('Y-m-d', strtotime($part[0]));
                        $end = date('Y-m-d', strtotime($part[1]));
                            $q->whereDate('created_at', '>=', $start)
                                ->whereDate('created_at', '<=', $end);
                    }
                    if (request('batch_type')){
                        $q->where('batch_type_id',request('batch_type'));
                    }
                    if (request('batch_mode')){
                        $q->where('batch_mode_id',request('batch_mode'));
                    }
                });
            })
            ->rawColumns(['action','batch_status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Batch $model)
    {
        $auth = Auth::user();
        DB::statement(DB::raw('set @rownum=0'));
        if ($auth->hasRole('super_admin') || $auth->hasRole('admin')){

            $model = Batch::select([DB::raw('@rownum := @rownum + 1 AS rank'),'course_id', 'batch_mode_id', 'trainer_id', 'name', 'start', 'status', 'batch_status','batch_type_id']);

        }else{
            $model =  Batch::whereHas('course', function($query) use($auth){
                $query->where('branch_id', $auth->branch_id);
            })->select([DB::raw('@rownum := @rownum + 1 AS rank'),'course_id', 'batch_mode_id', 'trainer_id', 'name', 'start', 'status', 'batch_status','batch_type_id']);

        }
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
//                'buttons' => [
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
//                ],
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
            'course_id',
            'batch_mode_id',
            'trainer_id',
            'name',
            'start',
            'status',
            'batch_status',
            'batch_type_id'

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'batchs_datatable_' . time();
    }
}
