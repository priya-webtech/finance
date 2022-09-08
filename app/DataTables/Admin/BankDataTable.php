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

class BankDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', ' ')
            ->editColumn('status', function ($record) {
                if ($record->status == 1){
                    $status = "<span class='badge badge-success'>Active</span>";
                }else{
                    $status = "<span class='badge badge-danger'>Block</span>";
                }
                return $status;
            })
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
            ->addColumn('slno','row_num',1)
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Carcompany $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {

        /*if (request('balance_type') == "cash"){
            DB::statement(DB::raw('set @rownum=0'));
            $model = ModeOfPayment::where('title','Cash')->select([DB::raw('@rownum := @rownum + 1 AS rank'), 'title', 'status','opening_balance']);
        }elseif(request('balance_type')  == "bank"){
            DB::statement(DB::raw('set @rownum=0'));
            $model = ModeOfPayment::where('title','!=','Cash')->select([DB::raw('@rownum := @rownum + 1 AS rank'), 'title', 'status','opening_balance']);
        }*/

        DB::statement(DB::raw('set @rownum=0'));
            $model = ModeOfPayment::select([DB::raw('@rownum := @rownum + 1 AS rank'), 'title', 'status','opening_balance']);
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
            'title',
            'status',
//            'name',
//            'ifsc_code',
//            'account_no',
//            'other_detail',
            'opening_balance',

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
