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
            ->addColumn('total_expense', function ($record){
                $auth = Auth::user();
                if ($auth->hasRole('super_admin') || $auth->hasRole('admin')){
                    $expense =  ExpenceMaster::where('expence_type_id',$record->id)
                        ->when(request('dates'), function ($q) {
                            $part = explode("-",request('dates'));
                            $start = date('Y-m-d', strtotime($part[0]));
                            $end = date('Y-m-d', strtotime($part[1]));
                            $q->whereDate('date', '>=', $start)
                                ->whereDate('date', '<=', $end);
                        });
                    $amount = $expense->sum('amount');

                    return "₹ ".$amount+$expense->sum('tds');
                }else{
                    $expense =  ExpenceMaster::where('branch_id',$auth->branch_id)->where('expence_type_id',$record->id)
                        ->when(request('dates'), function ($q) {
                            $part = explode("-",request('dates'));
                            $start = date('Y-m-d', strtotime($part[0]));
                            $end = date('Y-m-d', strtotime($part[1]));
                            $q->whereDate('date', '>=', $start)
                                ->whereDate('date', '<=', $end);
                        });
                    $amount = $expense->sum('amount');

                    return "₹ ".$amount+$expense->sum('tds');
                }

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
            ->rawColumns(['action','total_expense']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExpenseTypes $model)
    {
        DB::statement(DB::raw('set @rownum=0'));
//        $model->select([DB::raw('@rownum := @rownum + 1 AS rank'),'title']);
        return  $model->select([DB::raw('@rownum := @rownum + 1 AS rank'),'title','id'])->newQuery();
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
           'title'

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
