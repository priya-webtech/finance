<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\Student;
use App\Models\Admin\StudentBatchDetail;
use App\Models\Admin\StudentFessCollection;
use App\Models\Admin\Trainer;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TrainerDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')
            ->addColumn('paid', function ($record){
              $trainerPaid = ExpenceMaster::where('trainer_id',$record->id);
               $paid = $trainerPaid->sum('amount');
              return $paid+$trainerPaid->sum('tds');
            })
            ->addColumn('out_Standing', function ($record){
                $trainerfees = StudentBatchDetail::where('trainer_id',$record->id)->sum('trainer_fees');
                $trainerPaid = ExpenceMaster::where('trainer_id',$record->id);
                $paid = $trainerPaid->sum('amount');

                $paidFees = $paid+$trainerPaid->sum('tds');

                return $trainerfees -$paidFees;
            })
//            ->filter(function ($record){
//                $record->where(function ($q) {
//                    if (request('dates')){
//                        $part = explode("-",request('dates'));
//                        $start = date('Y-m-d', strtotime($part[0]));
//                        $end = date('Y-m-d', strtotime($part[1]));
//                            $q->whereDate('created_at', '>=', $start)
//                                ->whereDate('created_at', '<=', $end);
//                    }
//                });
//            })
            ->rawColumns(['action','out_Standing','paid']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Trainer $model)
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
           'trainer_name'

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'trainers_datatable_' . time();
    }
}
