<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Carcompany;
use App\Models\Admin\Corporate;
use App\Models\Admin\CorporateFessCollection;
use App\Models\Admin\Course;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\ExpenseTypes;
use App\Models\Admin\Income;
use App\Models\Admin\IncomeType;
use App\Models\Admin\Student;
use App\Models\Admin\StudentFessCollection;
use Illuminate\Support\Facades\Auth;
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
                $income = Income::where('course_id', '=', $record->id)->when(request('dates'), function ($q) {
                             $part = explode("-",request('dates'));
                             $start = date('Y-m-d', strtotime($part[0]));
                             $end = date('Y-m-d', strtotime($part[1]));
                             $q->whereDate('created_at', '>=', $start)
                                 ->whereDate('created_at', '<=', $end);
                         });
                $amount = $income->sum('paying_amount');
                $studentGst = StudentFessCollection::whereIn('income_id',$income->pluck('id'))->sum('gst');
                $corporateGst = CorporateFessCollection::whereIn('income_id',$income->pluck('id'))->sum('gst');
                return "₹ ".number_format($amount+$studentGst+$corporateGst,2);
            })

            ->filter(function ($record){
                $record->where(function ($q) {
                    if (request('income_type')){
                            $q->where('id', request('income_type'));
                    }
                });
            })
            ->rawColumns(['action','total_revenue']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Course $model)
    {
        DB::statement(DB::raw('set @rownum=0'));
        return  $model->select([DB::raw('@rownum := @rownum + 1 AS rank'),'course_name','id'])->newQuery();
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
//                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'course_name',
            'total_revenue'

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
