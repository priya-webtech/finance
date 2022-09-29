<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\Corporate;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ExpenseDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')
            ->addColumn('expence_type_id', function ($record){
               return $record->expenceType->title;
            })
            ->addColumn('branch_id', function ($record){
               $branch = ($record->branch->title) ? $record->branch->title : 'N/A';
               return $branch;
            })
            ->addColumn('bank_ac_id', function ($record){

               $bannk_acc = ($record->bankAcc->name) ? $record->bankAcc->name : 'N/A';
               return $bannk_acc;
            })
            ->addColumn('trainer_id', function ($record){

               $trainer = (!empty($record->trainer->trainer_name)) ? $record->trainer->trainer_name : 'N/A';
               return $trainer;
            })
            ->addColumn('tds', function ($record){
               $tds = (!empty($record->tds)) ? $record->tds : 'N/A';
               return $tds;
            })
            ->addColumn('remark', function ($record){
               $remark = (!empty($record->remark)) ? $record->remark : 'N/A';
               return $remark;
            })
//            ->filter(function ($record){
//                $record->where(function ($q) {
//
//                    if (request('dates')){
//                        dd(request('dates'));
//                        $part = explode("-",request('dates'));
//                        $start = date('Y-m-d', strtotime($part[0]));
//                        $end = date('Y-m-d', strtotime($part[1]));
//                            $q->whereDate('created_at', '>=', $start)
//                                ->whereDate('created_at', '<=', $end);
//                    }
//                });
//            })
//            ->addColumn('slno','row_num',1)
            ->rawColumns(['action','expence_type_id','branch_id','bank_ac_id','trainer_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExpenceMaster $model)
    {
        DB::statement(DB::raw('set @rownum=0'));
//        $model->select([DB::raw('@rownum := @rownum + 1 AS rank'),'title']);
        return  $model->select([DB::raw('@rownum := @rownum + 1 AS rank'),'remark','amount','tds','expence_type_id','branch_id','bank_ac_id','trainer_id'])->newQuery();
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
           'remark',
           'amount',
           'tds',



        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'expenses_datatable_' . time();
    }
}
