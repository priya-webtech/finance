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
         ->addColumn('income_bankk', function ($record){

                if($record->type == 'expence_masters'){
                   $modetitle = ModeOfPayment::where('id', $record->ExpenceMaster_bankk)->first();
                   return $modetitle->title;
                }else{
                     $modetitle = ModeOfPayment::where('id', $record->ExpenceMaster_bankk)->first();
                   return $modetitle->title;
                }  
            })
            ->editColumn('id', function ($record) {
               
                if($record->type == 'expence_masters'){
                   return 'N/A';
                }else{
                     $modetitle = StudentFessCollection::where('income_id', $record->id)->first();
                     if(!empty($modetitle->student_id)){
                          $studenttitle = Student::where('id', $modetitle->student_id)->first();
                         // dd($studenttitle->name);
                          return $studenttitle->name;
                      }else{
                         return 'N/A';
                      }
                }
            })
            ->editColumn('created_at', function ($record) {
             //   dd($record->created_at);
                if($record->type == 'expence_masters'){
                    $new_date =  date('d/m/Y',strtotime($record->created_at));
                    return $new_date;
                }else{
                    $new_date =  date('d/m/Y',strtotime($record->created_at));
                    return $new_date;
                }
            })
            ->editColumn('type', function ($record) {
             //   dd($record->created_at);
                if($record->type == 'expence_masters'){
                    $type =  'Expence';
                    return $type;
                }else{
                    $type = 'Income';
                    return $type;
                }
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

      //  DB::statement(DB::raw('set @rownum=0'));
        //    $model = ModeOfPayment::select([DB::raw('@rownum := @rownum + 1 AS rank'), 'title', 'status','opening_balance']);

      /*  $model = Income::join('expence_masters', 'incomes.bank_acc_id', '=', 'expence_masters.bank_ac_id')
                ->select([DB::raw('@rownum := @rownum + 1 AS rank'),'incomes.bank_acc_id as income_bankk','incomes.paying_amount as income_amount', 'incomes.created_at as income_date', 'expence_masters.bank_ac_id as ExpenceMaster_bankk', 'expence_masters.amount as ExpenceMaster_amount', 'expence_masters.created_at as ExpenceMaster_date'])->orderByRaw('COALESCE(incomes.created_at, expence_masters.created_at)');*/

       /* $first = DB::table('expence_masters');
        $model = DB::table('incomes')->union($first)->select([DB::raw('@rownum := @rownum + 1 AS rank'),'incomes.bank_acc_id as income_bankk','incomes.paying_amount as income_amount', 'incomes.created_at as income_date', 'expence_masters.bank_ac_id as ExpenceMaster_bankk', 'expence_masters.amount as ExpenceMaster_amount', 'expence_masters.created_at as ExpenceMaster_date']);*/
/*
        $first = DB::table('expence_masters')->select('bank_ac_id as ExpenceMaster_bankk', 'amount as ExpenceMaster_amount', 'created_at as ExpenceMaster_date');

        $model  = Income::select('bank_acc_id as income_bankk', 'paying_amount as income_amount', 'created_at as income_date')->unionAll($first);*/

        $photos = ExpenceMaster::select('bank_ac_id as ExpenceMaster_bankk', 'amount as ExpenceMaster_amount', 'created_at', 'type','id');
        $videos = Income::select('bank_acc_id as income_bankk', 'paying_amount as income_amount', 'created_at','type','id');
        $model = $photos->union($videos)->orderBy('created_at', 'desc');


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
            'income_bankk',
            'income_amount',
            'income_date',
            'ExpenceMaster_bankk',
            'ExpenceMaster_amount',
            'created_at',

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
