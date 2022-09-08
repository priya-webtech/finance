<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Batch;
use App\Models\Admin\Carcompany;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\ModeOfPayment;
use App\Models\Admin\Student;
use App\Models\Admin\StudentFessCollection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class GstDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')
            ->addColumn('id', function ($record){
                return 1;
            })
            ->addColumn('name', function ($record){
                return 'GST';
            })
            ->addColumn('total_gst', function ($record){
                $incomeGST = Income::sum('gst');
                $studentGST = StudentFessCollection::sum('gst');
                $corporateGST = CorporateFessCollection::sum('gst');
                return number_format($incomeGST+$studentGST+$corporateGST,2);
            })
//            ->editColumn('trainer_id', function ($record){
//                return $record->trainer->trainer_name;
//            })
//            ->editColumn('batch_type_id', function ($record) {
//                return $record->batchType->title;
//            })

//            ->filter(function ($record){
//                $record->where(function ($q) {
//                    if (request('balance_type')){
//                        if (request('balance_type') == "cash"){
//                            $q->where('title','Cash');
//                        }elseif(request('balance_type')  == "bank"){
//                            $q->where('title','Cheque');
//                        }
//
//                    }
//                });
//            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Income $model)
    {
        return  $model->take(1)->newQuery();
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
//            'id' => ['searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'banks_datatable_' . time();
    }
}
