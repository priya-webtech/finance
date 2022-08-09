<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\Student;
use App\Models\Admin\StudentFessCollection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class IncomeDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')
            ->addColumn('total_revenue', function ($record){
                $total = 0;
                if ($record->title == "Retail Training"){
                     $income = Income::where('income_type_id',$record->id)
                         ->when(request('dates'), function ($q) {
                             $part = explode("-",request('dates'));
                             $start = date('Y-m-d', strtotime($part[0]));
                             $end = date('Y-m-d', strtotime($part[1]));
                             $q->whereDate('created_at', '>=', $start)
                                 ->whereDate('created_at', '<=', $end);
                         });
                     $ids = $income->pluck('id')->toArray();
                     $gst = StudentFessCollection::whereIn('income_id',$ids)->sum('gst');
                     return "₹ ".$gst  +$income->sum('paying_amount');
                }else if ($record->title == "Corporate Training"){
                    $income = Income::where('income_type_id',$record->id);
                    $ids = $income->pluck('id')->toArray();
                    $gst = CorporateFessCollection::whereIn('income_id',$ids)->sum('gst');
                    return  "₹ ".$gst  +$income->sum('paying_amount');
                }else{
                 $income =  Income::where('income_type_id',$record->id);
                $amount = $income->sum('paying_amount');
                return "₹ ".$amount+$income->sum('gst');
                }
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
            ->rawColumns(['action','total_revenue']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(IncomeType $model)
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
        return 'incomes_datatable_' . time();
    }
}
