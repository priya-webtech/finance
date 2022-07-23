<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\PermissionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
//Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Auth::routes();





Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashBoardController::class, 'index'])->name('dashboard');
    // Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'profile'])->name('profile');
    Route::get('/get-trainer-batch', [App\Http\Controllers\Admin\ExpenceMasterController::class, 'trainerBatch'])->name('get-trainer-batch');
//    Route::get('/student/find', [App\Http\Controllers\Admin\ExpenceMasterController::class, 'find']);
    Route::get('/due-fees', [App\Http\Controllers\Admin\DueFeesController::class, 'index'])->name('due-fees');
    Route::get('/due-fees-corporate', [App\Http\Controllers\Admin\DueFeesController::class, 'corpodatatable'])->name('due-fees-corporate');
    Route::get('/search-record', [App\Http\Controllers\Admin\DueFeesController::class, 'searchRecord'])->name('search-record');
    Route::get('/count-batch-student', [App\Http\Controllers\Admin\IncomeController::class, 'countStud'])->name('count-batch-student');
    Route::post('/profile-update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile-update');
    Route::post('/change-password', [App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('change-password');
    //Role-Permission
    Route::get('/role-permission',[\App\Http\Controllers\Security\RolePermission::class, 'index'])->name('role.permission.list');
    Route::post('/role-permission/store',[\App\Http\Controllers\Security\RolePermission::class, 'store'])->name('role.permission.store');
    Route::resource('permission',PermissionController::class);
    Route::get('permission-delete/{id}',[\App\Http\Controllers\Security\PermissionController::class, 'destroy'])->name('permission-delete');
    Route::resource('role', RoleController::class);
    Route::get('role-delete/{id}',[\App\Http\Controllers\Security\RoleController::class, 'destroy'])->name('role-delete');
    // Route::resource('settings', App\Http\Controllers\admin\SettingController::class, ["as" => 'admin']);
    Route::resource('leadSources', App\Http\Controllers\Admin\LeadSourcesController::class, ["as" => 'admin']);
    Route::resource('expenseTypes', App\Http\Controllers\Admin\ExpenseTypesController::class, ["as" => 'admin']);
    Route::resource('enquiryTypes', App\Http\Controllers\Admin\EnquiryTypeController::class, ["as" => 'admin']);
    Route::resource('incomeTypes', App\Http\Controllers\Admin\IncomeTypeController::class, ["as" => 'admin']);
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class, ["as" => 'admin']);
    Route::resource('batches', App\Http\Controllers\Admin\BatchController::class, ["as" => 'admin']);
    Route::resource('incomes', App\Http\Controllers\Admin\IncomeController::class, ["as" => 'admin']);
    Route::resource('trainers', App\Http\Controllers\Admin\TrainerController::class, ["as" => 'admin']);
    Route::resource('students', App\Http\Controllers\Admin\StudentController::class, ["as" => 'admin']);
    Route::resource('batchModes', App\Http\Controllers\Admin\BatchModeController::class, ["as" => 'admin']);
    Route::resource('revenueTypes', App\Http\Controllers\Admin\RevenueTypeController::class, ["as" => 'admin']);
    Route::resource('batchTypes', App\Http\Controllers\Admin\BatchTypeController::class, ["as" => 'admin']);
    Route::resource('modeOfPayments', App\Http\Controllers\Admin\ModeOfPaymentController::class, ["as" => 'admin']);
    Route::resource('branches', App\Http\Controllers\Admin\BranchController::class, ["as" => 'admin']);
    Route::resource('franchises', App\Http\Controllers\Admin\FranchiseController::class, ["as" => 'admin']);
    Route::resource('studentTypes', App\Http\Controllers\Admin\StudentTypeController::class, ["as" => 'admin']);
    Route::resource('settings', App\Http\Controllers\Admin\SettingController::class, ["as" => 'admin']);
    Route::resource('bankAccounts', App\Http\Controllers\Admin\BankAccountController::class, ["as" => 'admin']);
    Route::resource('trainerFreeSlabs', App\Http\Controllers\Admin\TrainerFreeSlabController::class, ["as" => 'admin']);
    Route::resource('corporates', App\Http\Controllers\Admin\CorporateController::class, ["as" => 'admin']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class, ["as" => 'admin']);
    Route::resource('expenceMasters', App\Http\Controllers\Admin\ExpenceMasterController::class, ["as" => 'admin']);
    //income related Route
    Route::get('/get-batch', [App\Http\Controllers\Admin\IncomeController::class, 'getBatch'])->name('get-batch');
    Route::get('/get-trainer', [App\Http\Controllers\Admin\IncomeController::class, 'getTrainer'])->name('get-trainer');
    Route::get('table/status/{table_id}/{table_name}/{status}',function ($table_id,$table_name,$status){
        changeTableStatus($table_id,$table_name,$status);
        return redirect()->back()->with('success','Status Updated Successfully');
    })->name('table.status');
});

