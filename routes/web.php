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
    Route::get('/expense-verify', [App\Http\Controllers\Admin\ExpenceMasterController::class, 'expenseVerify'])->name('expense-verify');
//    Route::get('/student/find', [App\Http\Controllers\Admin\ExpenceMasterController::class, 'find']);
    Route::get('/due-fees', [App\Http\Controllers\Admin\DueFeesController::class, 'index'])->name('due-fees');
    Route::get('/due-fees/{id}/{type}', [App\Http\Controllers\Admin\DueFeesController::class, 'edit'])->name('due-fees-edit');
    Route::post('/pay-due-fees/{id}/{type}', [App\Http\Controllers\Admin\DueFeesController::class, 'update'])->name('pay-due-fees');
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

    //Route::resource('leadSources', App\Http\Controllers\Admin\LeadSourcesController::class, ["as" => 'admin']);
    Route::get('leadSources', ['as' => 'admin.leadSources.index', 'uses' => 'App\Http\Controllers\Admin\LeadSourcesController@index', 'middleware' => 'can:leadsources_view']);
    Route::get('leadSources/create', ['as' => 'admin.leadSources.create', 'uses' => 'App\Http\Controllers\Admin\LeadSourcesController@create', 'middleware' => 'can:leadsources_create']);
    Route::post('leadSources/store', ['as' => 'admin.leadSources.store', 'uses' => 'App\Http\Controllers\Admin\LeadSourcesController@store', 'middleware' => 'can:leadsources_create']);
    Route::get('leadSources/{id}', ['as' => 'admin.leadSources.show', 'uses' => 'App\Http\Controllers\Admin\LeadSourcesController@show', 'middleware' => 'can:leadsources_view']);
    Route::get('leadSources/{id}/edit', ['as' => 'admin.leadSources.edit', 'uses' => 'App\Http\Controllers\Admin\LeadSourcesController@edit', 'middleware' => 'can:leadsources_edit']);
    Route::patch('leadSources/{id}', ['as' => 'admin.leadSources.update', 'uses' => 'App\Http\Controllers\Admin\LeadSourcesController@update', 'middleware' => 'can:leadsources_edit']);
    Route::delete('leadSources/{id}', ['as' => 'admin.leadSources.destroy', 'uses' => 'App\Http\Controllers\Admin\LeadSourcesController@destroy', 'middleware' => 'can:leadsources_delete']);

    //Route::resource('expenseTypes', App\Http\Controllers\Admin\ExpenseTypesController::class, ["as" => 'admin']);
    Route::get('expenseTypes', ['as' => 'admin.expenseTypes.index', 'uses' => 'App\Http\Controllers\Admin\ExpenseTypesController@index','middleware' => 'can:expensetypes_view']);
    Route::get('expenseTypes/create', ['as' => 'admin.expenseTypes.create', 'uses' => 'App\Http\Controllers\Admin\ExpenseTypesController@create', 'middleware' => 'can:expensetypes_create']);
    Route::post('expenseTypes/store', ['as' => 'admin.expenseTypes.store', 'uses' => 'App\Http\Controllers\Admin\ExpenseTypesController@store', 'middleware' => 'can:expensetypes_create']);
    Route::get('expenseTypes/{id}', ['as' => 'admin.expenseTypes.show', 'uses' => 'App\Http\Controllers\Admin\ExpenseTypesController@show', 'middleware' => 'can:expensetypes_view']);
    Route::get('expenseTypes/{id}/edit', ['as' => 'admin.expenseTypes.edit', 'uses' => 'App\Http\Controllers\Admin\ExpenseTypesController@edit', 'middleware' => 'can:expensetypes_edit']);
    Route::patch('expenseTypes/{id}', ['as' => 'admin.expenseTypes.update', 'uses' => 'App\Http\Controllers\Admin\ExpenseTypesController@update', 'middleware' => 'can:expensetypes_edit']);
    Route::delete('expenseTypes/{id}', ['as' => 'admin.expenseTypes.destroy', 'uses' => 'App\Http\Controllers\Admin\ExpenseTypesController@destroy', 'middleware' => 'can:expensetypes_delete']);

    //Route::resource('enquiryTypes', App\Http\Controllers\Admin\EnquiryTypeController::class, ["as" => 'admin']);
    Route::get('enquiryTypes', ['as' => 'admin.enquiryTypes.index', 'uses' => 'App\Http\Controllers\Admin\EnquiryTypeController@index','middleware' => 'can:enquiry_view']);
    Route::get('enquiryTypes/create', ['as' => 'admin.enquiryTypes.create', 'uses' => 'App\Http\Controllers\Admin\EnquiryTypeController@create', 'middleware' => 'can:enquiry_create']);
    Route::post('enquiryTypes/store', ['as' => 'admin.enquiryTypes.store', 'uses' => 'App\Http\Controllers\Admin\EnquiryTypeController@store', 'middleware' => 'can:enquiry_create']);
    Route::get('enquiryTypes/{id}', ['as' => 'admin.enquiryTypes.show', 'uses' => 'App\Http\Controllers\Admin\EnquiryTypeController@show', 'middleware' => 'can:enquiry_view']);
    Route::get('enquiryTypes/{id}/edit', ['as' => 'admin.enquiryTypes.edit', 'uses' => 'App\Http\Controllers\Admin\EnquiryTypeController@edit', 'middleware' => 'can:enquiry_edit']);
    Route::patch('enquiryTypes/{id}', ['as' => 'admin.enquiryTypes.update', 'uses' => 'App\Http\Controllers\Admin\EnquiryTypeController@update', 'middleware' => 'can:enquiry_edit']);
    Route::delete('enquiryTypes/{id}', ['as' => 'admin.enquiryTypes.destroy', 'uses' => 'App\Http\Controllers\Admin\EnquiryTypeController@destroy', 'middleware' => 'can:enquiry_delete']);

    //Route::resource('incomeTypes', App\Http\Controllers\Admin\IncomeTypeController::class, ["as" => 'admin']);
    Route::get('incomeTypes', ['as' => 'admin.incomeTypes.index', 'uses' => 'App\Http\Controllers\Admin\IncomeTypeController@index','middleware' => 'can:incometypes_view']);
    Route::get('incomeTypes/create', ['as' => 'admin.incomeTypes.create', 'uses' => 'App\Http\Controllers\Admin\IncomeTypeController@create', 'middleware' => 'can:incometypes_create']);
    Route::post('incomeTypes/store', ['as' => 'admin.incomeTypes.store', 'uses' => 'App\Http\Controllers\Admin\IncomeTypeController@store', 'middleware' => 'can:incometypes_create']);
    Route::get('incomeTypes/{id}', ['as' => 'admin.incomeTypes.show', 'uses' => 'App\Http\Controllers\Admin\IncomeTypeController@show', 'middleware' => 'can:incometypes_view']);
    Route::get('incomeTypes/{id}/edit', ['as' => 'admin.incomeTypes.edit', 'uses' => 'App\Http\Controllers\Admin\IncomeTypeController@edit', 'middleware' => 'can:incometypes_edit']);
    Route::patch('incomeTypes/{id}', ['as' => 'admin.incomeTypes.update', 'uses' => 'App\Http\Controllers\Admin\IncomeTypeController@update', 'middleware' => 'can:incometypes_edit']);
    Route::delete('incomeTypes/{id}', ['as' => 'admin.incomeTypes.destroy', 'uses' => 'App\Http\Controllers\Admin\IncomeTypeController@destroy', 'middleware' => 'can:incometypes_delete']);

    //Route::resource('courses', App\Http\Controllers\Admin\CourseController::class, ["as" => 'admin']);
    Route::get('courses', ['as' => 'admin.courses.index', 'uses' => 'App\Http\Controllers\Admin\CourseController@index','middleware' => 'can:courses_view']);
    Route::post('coursecolums-coursees', ['as' => 'admin.courseescoursecolums.coursecolums', 'uses' => 'App\Http\Controllers\Admin\CourseController@coursecolums']);

    Route::get('courses/create', ['as' => 'admin.courses.create', 'uses' => 'App\Http\Controllers\Admin\CourseController@create', 'middleware' => 'can:courses_create']);
    Route::post('courses/store', ['as' => 'admin.courses.store', 'uses' => 'App\Http\Controllers\Admin\CourseController@store', 'middleware' => 'can:courses_create']);
    Route::get('courses/{id}', ['as' => 'admin.courses.show', 'uses' => 'App\Http\Controllers\Admin\CourseController@show', 'middleware' => 'can:courses_view']);
    Route::get('courses/{id}/edit', ['as' => 'admin.courses.edit', 'uses' => 'App\Http\Controllers\Admin\CourseController@edit', 'middleware' => ['can:courses_edit','role']]);
    Route::patch('courses/{id}', ['as' => 'admin.courses.update', 'uses' => 'App\Http\Controllers\Admin\CourseController@update', 'middleware' => 'can:courses_edit']);
    Route::delete('courses/{id}', ['as' => 'admin.courses.destroy', 'uses' => 'App\Http\Controllers\Admin\CourseController@destroy', 'middleware' => 'can:courses_delete']);

   // Route::resource('batches', App\Http\Controllers\Admin\BatchController::class, ["as" => 'admin']);
    Route::get('batches', ['as' => 'admin.batches.index', 'uses' => 'App\Http\Controllers\Admin\BatchController@index','middleware' => 'can:batches_view']);
    Route::post('filter-batches', ['as' => 'admin.batchesFilter.filter', 'uses' => 'App\Http\Controllers\Admin\BatchController@filter']);
    Route::post('batchcolums-batches', ['as' => 'admin.batchesbatchcolums.batchcolums', 'uses' => 'App\Http\Controllers\Admin\BatchController@batchcolums']);
    Route::get('batches/create', ['as' => 'admin.batches.create', 'uses' => 'App\Http\Controllers\Admin\BatchController@create', 'middleware' => 'can:batches_create']);
    Route::post('batches/store', ['as' => 'admin.batches.store', 'uses' => 'App\Http\Controllers\Admin\BatchController@store', 'middleware' => 'can:batches_create']);
    Route::get('batches/{id}', ['as' => 'admin.batches.show', 'uses' => 'App\Http\Controllers\Admin\BatchController@show', 'middleware' => 'can:batches_view']);
    Route::get('batches/{id}/edit', ['as' => 'admin.batches.edit', 'uses' => 'App\Http\Controllers\Admin\BatchController@edit', 'middleware' => ['can:batches_edit','role']]);
    Route::patch('batches/{id}', ['as' => 'admin.batches.update', 'uses' => 'App\Http\Controllers\Admin\BatchController@update', 'middleware' => 'can:batches_edit']);
    Route::delete('batches/{id}', ['as' => 'admin.batches.destroy', 'uses' => 'App\Http\Controllers\Admin\BatchController@destroy', 'middleware' => 'can:batches_delete']);

    //Route::resource('incomes', App\Http\Controllers\Admin\IncomeController::class, ["as" => 'admin']);
    Route::get('incomes', ['as' => 'admin.incomes.index', 'uses' => 'App\Http\Controllers\Admin\IncomeController@index','middleware' => 'can:incomes_view']);
    Route::get('filter-incomes', ['as' => 'admin.incomesFilter.filter', 'uses' => 'App\Http\Controllers\Admin\IncomeController@filter']);
    Route::post('incomecolums-incomees', ['as' => 'admin.incomeesincomecolums.incomecolums', 'uses' => 'App\Http\Controllers\Admin\IncomeController@incomecolums']);
    Route::get('incomes/create', ['as' => 'admin.incomes.create', 'uses' => 'App\Http\Controllers\Admin\IncomeController@create', 'middleware' => 'can:incomes_create']);
    Route::post('incomes/store', ['as' => 'admin.incomes.store', 'uses' => 'App\Http\Controllers\Admin\IncomeController@store', 'middleware' => 'can:incomes_create']);
    Route::get('incomes/{id}', ['as' => 'admin.incomes.show', 'uses' => 'App\Http\Controllers\Admin\IncomeController@show', 'middleware' => 'can:incomes_view']);
    Route::get('incomes/{id}/edit', ['as' => 'admin.incomes.edit', 'uses' => 'App\Http\Controllers\Admin\IncomeController@edit', 'middleware' => ['can:incomes_edit','role']]);
    Route::patch('incomes/{id}', ['as' => 'admin.incomes.update', 'uses' => 'App\Http\Controllers\Admin\IncomeController@update', 'middleware' => 'can:incomes_edit']);
    Route::delete('incomes/{id}', ['as' => 'admin.incomes.destroy', 'uses' => 'App\Http\Controllers\Admin\IncomeController@destroy', 'middleware' => 'can:incomes_delete']);

    //Route::resource('trainers', App\Http\Controllers\Admin\TrainerController::class, ["as" => 'admin']);
    Route::get('trainers', ['as' => 'admin.trainers.index', 'uses' => 'App\Http\Controllers\Admin\TrainerController@index','middleware' => 'can:trainers_view']);
    Route::post('trainercolums-traineres', ['as' => 'admin.trainerestrainercolums.trainercolums', 'uses' => 'App\Http\Controllers\Admin\TrainerController@trainercolums']);

    Route::get('trainers/create', ['as' => 'admin.trainers.create', 'uses' => 'App\Http\Controllers\Admin\TrainerController@create', 'middleware' => 'can:trainers_create']);
    Route::post('trainers/store', ['as' => 'admin.trainers.store', 'uses' => 'App\Http\Controllers\Admin\TrainerController@store', 'middleware' => 'can:trainers_create']);
    Route::get('trainers/{id}', ['as' => 'admin.trainers.show', 'uses' => 'App\Http\Controllers\Admin\TrainerController@show', 'middleware' => 'can:trainers_view']);
    Route::get('trainers/{id}/edit', ['as' => 'admin.trainers.edit', 'uses' => 'App\Http\Controllers\Admin\TrainerController@edit', 'middleware' => ['can:trainers_edit','role']]);
    Route::patch('trainers/{id}', ['as' => 'admin.trainers.update', 'uses' => 'App\Http\Controllers\Admin\TrainerController@update', 'middleware' => 'can:trainers_edit']);
    Route::delete('trainers/{id}', ['as' => 'admin.trainers.destroy', 'uses' => 'App\Http\Controllers\Admin\TrainerController@destroy', 'middleware' => 'can:trainers_delete']);

    //Route::resource('students', App\Http\Controllers\Admin\StudentController::class, ["as" => 'admin']);
    Route::get('students', ['as' => 'admin.students.index', 'uses' => 'App\Http\Controllers\Admin\StudentController@index','middleware' => 'can:students_view']);
    Route::post('studentcolums-studentes', ['as' => 'admin.studentesstudentcolums.studentcolums', 'uses' => 'App\Http\Controllers\Admin\StudentController@studentcolums']);
    Route::get('students/create', ['as' => 'admin.students.create', 'uses' => 'App\Http\Controllers\Admin\StudentController@create', 'middleware' => 'can:students_create']);
    Route::post('students/store', ['as' => 'admin.students.store', 'uses' => 'App\Http\Controllers\Admin\StudentController@store', 'middleware' => 'can:students_create']);
    Route::get('students/{id}', ['as' => 'admin.students.show', 'uses' => 'App\Http\Controllers\Admin\StudentController@show', 'middleware' => 'can:students_view']);
    Route::get('students/{id}/edit', ['as' => 'admin.students.edit', 'uses' => 'App\Http\Controllers\Admin\StudentController@edit', 'middleware' => 'can:students_edit']);
    Route::patch('students/{id}', ['as' => 'admin.students.update', 'uses' => 'App\Http\Controllers\Admin\StudentController@update', 'middleware' => 'can:students_edit']);
    Route::delete('students/{id}', ['as' => 'admin.students.destroy', 'uses' => 'App\Http\Controllers\Admin\StudentController@destroy', 'middleware' => 'can:students_delete']);

    //Route::resource('batchModes', App\Http\Controllers\Admin\BatchModeController::class, ["as" => 'admin']);
    Route::get('batchModes', ['as' => 'admin.batchModes.index', 'uses' => 'App\Http\Controllers\Admin\BatchModeController@index','middleware' => 'can:batchmodes_view']);
    Route::get('batchModes/create', ['as' => 'admin.batchModes.create', 'uses' => 'App\Http\Controllers\Admin\BatchModeController@create', 'middleware' => 'can:batchmodes_create']);
    Route::post('batchModes/store', ['as' => 'admin.batchModes.store', 'uses' => 'App\Http\Controllers\Admin\BatchModeController@store', 'middleware' => 'can:batchModes_create']);
    Route::get('batchModes/{id}', ['as' => 'admin.batchModes.show', 'uses' => 'App\Http\Controllers\Admin\BatchModeController@show', 'middleware' => 'can:batchmodes_view']);
    Route::get('batchModes/{id}/edit', ['as' => 'admin.batchModes.edit', 'uses' => 'App\Http\Controllers\Admin\BatchModeController@edit', 'middleware' => 'can:batchmodes_edit']);
    Route::patch('batchModes/{id}', ['as' => 'admin.batchModes.update', 'uses' => 'App\Http\Controllers\Admin\BatchModeController@update', 'middleware' => 'can:batchmodes_edit']);
    Route::delete('batchModes/{id}', ['as' => 'admin.batchModes.destroy', 'uses' => 'App\Http\Controllers\Admin\BatchModeController@destroy', 'middleware' => 'can:batchmodes_delete']);

    //Route::resource('revenueTypes', App\Http\Controllers\Admin\RevenueTypeController::class, ["as" => 'admin']);
    Route::get('revenueTypes', ['as' => 'admin.revenueTypes.index', 'uses' => 'App\Http\Controllers\Admin\RevenueTypeController@index','middleware' => 'can:revenuetypes_view']);
    Route::get('revenueTypes/create', ['as' => 'admin.revenueTypes.create', 'uses' => 'App\Http\Controllers\Admin\RevenueTypeController@create', 'middleware' => 'can:revenuetypes_create']);
    Route::post('revenueTypes/store', ['as' => 'admin.revenueTypes.store', 'uses' => 'App\Http\Controllers\Admin\RevenueTypeController@store', 'middleware' => 'can:revenuetypes_create']);
    Route::get('revenueTypes/{id}', ['as' => 'admin.revenueTypes.show', 'uses' => 'App\Http\Controllers\Admin\RevenueTypeController@show', 'middleware' => 'can:revenuetypes_view']);
    Route::get('revenueTypes/{id}/edit', ['as' => 'admin.revenueTypes.edit', 'uses' => 'App\Http\Controllers\Admin\RevenueTypeController@edit', 'middleware' => 'can:revenuetypes_edit']);
    Route::patch('revenueTypes/{id}', ['as' => 'admin.revenueTypes.update', 'uses' => 'App\Http\Controllers\Admin\RevenueTypeController@update', 'middleware' => 'can:revenuetypes_edit']);
    Route::delete('revenueTypes/{id}', ['as' => 'admin.revenueTypes.destroy', 'uses' => 'App\Http\Controllers\Admin\RevenueTypeController@destroy', 'middleware' => 'can:revenuetypes_delete']);

    //Route::resource('batchTypes', App\Http\Controllers\Admin\BatchTypeController::class, ["as" => 'admin']);
     Route::get('batchTypes', ['as' => 'admin.batchTypes.index', 'uses' => 'App\Http\Controllers\Admin\BatchTypeController@index','middleware' => 'can:batchtypes_view']);
    Route::get('batchTypes/create', ['as' => 'admin.batchTypes.create', 'uses' => 'App\Http\Controllers\Admin\BatchTypeController@create', 'middleware' => 'can:batchtypes_create']);
    Route::post('batchTypes/store', ['as' => 'admin.batchTypes.store', 'uses' => 'App\Http\Controllers\Admin\BatchTypeController@store', 'middleware' => 'can:batchtypes_create']);
    Route::get('batchTypes/{id}', ['as' => 'admin.batchTypes.show', 'uses' => 'App\Http\Controllers\Admin\BatchTypeController@show', 'middleware' => 'can:batchtypes_view']);
    Route::get('batchTypes/{id}/edit', ['as' => 'admin.batchTypes.edit', 'uses' => 'App\Http\Controllers\Admin\BatchTypeController@edit', 'middleware' => 'can:batchtypes_edit']);
    Route::patch('batchTypes/{id}', ['as' => 'admin.batchTypes.update', 'uses' => 'App\Http\Controllers\Admin\BatchTypeController@update', 'middleware' => 'can:batchtypes_edit']);
    Route::delete('batchTypes/{id}', ['as' => 'admin.batchTypes.destroy', 'uses' => 'App\Http\Controllers\Admin\BatchTypeController@destroy', 'middleware' => 'can:batchtypes_delete']);

    //Route::resource('modeOfPayments', App\Http\Controllers\Admin\ModeOfPaymentController::class, ["as" => 'admin']);
    Route::get('modeOfPayments', ['as' => 'admin.modeOfPayments.index', 'uses' => 'App\Http\Controllers\Admin\ModeOfPaymentController@index','middleware' => 'can:payments_view']);
    Route::get('modeOfPayments/create', ['as' => 'admin.modeOfPayments.create', 'uses' => 'App\Http\Controllers\Admin\ModeOfPaymentController@create', 'middleware' => 'can:payments_view']);
    Route::post('modeOfPayments/store', ['as' => 'admin.modeOfPayments.store', 'uses' => 'App\Http\Controllers\Admin\ModeOfPaymentController@store', 'middleware' => 'can:payments_create']);
    Route::get('modeOfPayments/{id}', ['as' => 'admin.modeOfPayments.show', 'uses' => 'App\Http\Controllers\Admin\ModeOfPaymentController@show', 'middleware' => 'can:payments_view']);
    Route::get('modeOfPayments/{id}/edit', ['as' => 'admin.modeOfPayments.edit', 'uses' => 'App\Http\Controllers\Admin\ModeOfPaymentController@edit', 'middleware' => 'can:payments_edit']);
    Route::patch('modeOfPayments/{id}', ['as' => 'admin.modeOfPayments.update', 'uses' => 'App\Http\Controllers\Admin\ModeOfPaymentController@update', 'middleware' => 'can:payments_edit']);
    Route::delete('modeOfPayments/{id}', ['as' => 'admin.modeOfPayments.destroy', 'uses' => 'App\Http\Controllers\Admin\ModeOfPaymentController@destroy', 'middleware' => 'can:payments_delete']);

    //Route::resource('branches', App\Http\Controllers\Admin\BranchController::class, ["as" => 'admin']);
    Route::get('branches', ['as' => 'admin.branches.index', 'uses' => 'App\Http\Controllers\Admin\BranchController@index','middleware' => 'can:branch_view']);
    Route::get('branches/create', ['as' => 'admin.branches.create', 'uses' => 'App\Http\Controllers\Admin\BranchController@create', 'middleware' => 'can:branch_create']);
    Route::post('branches/store', ['as' => 'admin.branches.store', 'uses' => 'App\Http\Controllers\Admin\BranchController@store', 'middleware' => 'can:branch_create']);
    Route::get('branches/{id}', ['as' => 'admin.branches.show', 'uses' => 'App\Http\Controllers\Admin\BranchController@show', 'middleware' => 'can:branch_view']);
    Route::get('branches/{id}/edit', ['as' => 'admin.branches.edit', 'uses' => 'App\Http\Controllers\Admin\BranchController@edit', 'middleware' => 'can:branch_edit']);
    Route::patch('branches/{id}', ['as' => 'admin.branches.update', 'uses' => 'App\Http\Controllers\Admin\BranchController@update', 'middleware' => 'can:branch_edit']);
    Route::delete('branches/{id}', ['as' => 'admin.branches.destroy', 'uses' => 'App\Http\Controllers\Admin\BranchController@destroy', 'middleware' => 'can:branch_delete']);

    //Route::resource('franchises', App\Http\Controllers\Admin\FranchiseController::class, ["as" => 'admin']);
    Route::get('franchises', ['as' => 'admin.franchises.index', 'uses' => 'App\Http\Controllers\Admin\FranchiseController@index','middleware' => 'can:franchises_view']);
    Route::get('franchises/create', ['as' => 'admin.franchises.create', 'uses' => 'App\Http\Controllers\Admin\FranchiseController@create', 'middleware' => 'can:franchises_create']);
    Route::post('franchises/store', ['as' => 'admin.franchises.store', 'uses' => 'App\Http\Controllers\Admin\FranchiseController@store', 'middleware' => 'can:franchises_create']);
    Route::get('franchises/{id}', ['as' => 'admin.franchises.show', 'uses' => 'App\Http\Controllers\Admin\FranchiseController@show', 'middleware' => 'can:franchises_view']);
    Route::get('franchises/{id}/edit', ['as' => 'admin.franchises.edit', 'uses' => 'App\Http\Controllers\Admin\FranchiseController@edit', 'middleware' => 'can:franchises_edit']);
    Route::patch('franchises/{id}', ['as' => 'admin.franchises.update', 'uses' => 'App\Http\Controllers\Admin\FranchiseController@update', 'middleware' => 'can:franchises_edit']);
    Route::delete('franchises/{id}', ['as' => 'admin.franchises.destroy', 'uses' => 'App\Http\Controllers\Admin\FranchiseController@destroy', 'middleware' => 'can:franchises_delete']);

    //Route::resource('studentTypes', App\Http\Controllers\Admin\StudentTypeController::class, ["as" => 'admin']);
    Route::get('studentTypes', ['as' => 'admin.studentTypes.index', 'uses' => 'App\Http\Controllers\Admin\StudentTypeController@index','middleware' => 'can:studenttypes_view']);
    Route::get('studentTypes/create', ['as' => 'admin.studentTypes.create', 'uses' => 'App\Http\Controllers\Admin\StudentTypeController@create', 'middleware' => 'can:studenttypes_create']);
    Route::post('studentTypes/store', ['as' => 'admin.studentTypes.store', 'uses' => 'App\Http\Controllers\Admin\StudentTypeController@store', 'middleware' => 'can:studenttypes_create']);
    Route::get('studentTypes/{id}', ['as' => 'admin.studentTypes.show', 'uses' => 'App\Http\Controllers\Admin\StudentTypeController@show', 'middleware' => 'can:studenttypes_view']);
    Route::get('studentTypes/{id}/edit', ['as' => 'admin.studentTypes.edit', 'uses' => 'App\Http\Controllers\Admin\StudentTypeController@edit', 'middleware' => 'can:studenttypes_edit']);
    Route::patch('studentTypes/{id}', ['as' => 'admin.studentTypes.update', 'uses' => 'App\Http\Controllers\Admin\StudentTypeController@update', 'middleware' => 'can:studenttypes_edit']);
    Route::delete('studentTypes/{id}', ['as' => 'admin.studentTypes.destroy', 'uses' => 'App\Http\Controllers\Admin\StudentTypeController@destroy', 'middleware' => 'can:studenttypes_delete']);

    //Route::resource('settings', App\Http\Controllers\Admin\SettingController::class, ["as" => 'admin']);
    Route::get('settings', ['as' => 'admin.settings.index', 'uses' => 'App\Http\Controllers\Admin\SettingController@index','middleware' => 'can:settings_view']);
    Route::get('settings/create', ['as' => 'admin.settings.create', 'uses' => 'App\Http\Controllers\Admin\SettingController@create', 'middleware' => 'can:settings_create']);
    Route::post('settings/store', ['as' => 'admin.settings.store', 'uses' => 'App\Http\Controllers\Admin\SettingController@store', 'middleware' => 'can:settings_create']);
    Route::get('settings/{id}', ['as' => 'admin.settings.show', 'uses' => 'App\Http\Controllers\Admin\SettingController@show', 'middleware' => 'can:settings_view']);
    Route::get('settings/{id}/edit', ['as' => 'admin.settings.edit', 'uses' => 'App\Http\Controllers\Admin\SettingController@edit', 'middleware' => 'can:settings_edit']);
    Route::patch('settings/{id}', ['as' => 'admin.settings.update', 'uses' => 'App\Http\Controllers\Admin\SettingController@update', 'middleware' => 'can:settings_edit']);
    Route::delete('settings/{id}', ['as' => 'admin.settings.destroy', 'uses' => 'App\Http\Controllers\Admin\SettingController@destroy', 'middleware' => 'can:settings_delete']);

    Route::resource('bankAccounts', App\Http\Controllers\Admin\BankAccountController::class, ["as" => 'admin']);
    Route::resource('trainerFreeSlabs', App\Http\Controllers\Admin\TrainerFreeSlabController::class, ["as" => 'admin']);
    //Route::resource('corporates', App\Http\Controllers\Admin\CorporateController::class, ["as" => 'admin']);
    Route::get('corporates', ['as' => 'admin.corporates.index', 'uses' => 'App\Http\Controllers\Admin\CorporateController@index','middleware' => 'can:corporates_view']);
    Route::post('corporatecolums-corporatees', ['as' => 'admin.corporateescorporatecolums.corporatecolums', 'uses' => 'App\Http\Controllers\Admin\CorporateController@corporatecolums']);
    Route::post('filter-corporates', ['as' => 'admin.corporatesFilter.filter', 'uses' => 'App\Http\Controllers\Admin\CorporateController@filter']);
    Route::get('corporates/create', ['as' => 'admin.corporates.create', 'uses' => 'App\Http\Controllers\Admin\CorporateController@create', 'middleware' => 'can:corporates_create']);
    Route::post('corporates/store', ['as' => 'admin.corporates.store', 'uses' => 'App\Http\Controllers\Admin\CorporateController@store', 'middleware' => 'can:corporates_create']);
    Route::get('corporates/{id}', ['as' => 'admin.corporates.show', 'uses' => 'App\Http\Controllers\Admin\CorporateController@show', 'middleware' => 'can:corporates_view']);
    Route::get('corporates/{id}/edit', ['as' => 'admin.corporates.edit', 'uses' => 'App\Http\Controllers\Admin\CorporateController@edit', 'middleware' => ['can:corporates_edit','role']]);
    Route::patch('corporates/{id}', ['as' => 'admin.corporates.update', 'uses' => 'App\Http\Controllers\Admin\CorporateController@update', 'middleware' => 'can:corporates_edit']);
    Route::delete('corporates/{id}', ['as' => 'admin.corporates.destroy', 'uses' => 'App\Http\Controllers\Admin\CorporateController@destroy', 'middleware' => 'can:corporates_delete']);
 //  Route::group(['middleware' => 'role'], function () {
  //  Route::resource('users', App\Http\Controllers\Admin\UserController::class, ["as" => 'admin']);
    Route::get('users', ['as' => 'admin.users.index', 'uses' => 'App\Http\Controllers\Admin\UserController@index','middleware' => 'can:user_view']);
    Route::post('usercolums-useres', ['as' => 'admin.useresusercolums.usercolums', 'uses' => 'App\Http\Controllers\Admin\UserController@usercolums']);
    Route::get('users/create', ['as' => 'admin.users.create', 'uses' => 'App\Http\Controllers\Admin\UserController@create', 'middleware' => 'can:user_create']);
    Route::post('users/store', ['as' => 'admin.users.store', 'uses' => 'App\Http\Controllers\Admin\UserController@store', 'middleware' => 'can:user_create']);
    Route::get('users/{id}', ['as' => 'admin.users.show', 'uses' => 'App\Http\Controllers\Admin\UserController@show', 'middleware' => 'can:user_view']);
    Route::get('users/{id}/edit', ['as' => 'admin.users.edit', 'uses' => 'App\Http\Controllers\Admin\UserController@edit', 'middleware' => ['can:user_edit','role']]);
    Route::patch('users/{id}', ['as' => 'admin.users.update', 'uses' => 'App\Http\Controllers\Admin\UserController@update', 'middleware' => 'can:user_edit']);
    Route::delete('users/{id}', ['as' => 'admin.users.destroy', 'uses' => 'App\Http\Controllers\Admin\UserController@destroy', 'middleware' => 'can:user_delete']);
//     });

   // Route::resource('expenceMasters', App\Http\Controllers\Admin\ExpenceMasterController::class, ["as" => 'admin']);
    Route::get('expenceMasters', ['as' => 'admin.expenceMasters.index', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@index','middleware' => 'can:expence_view']);
    Route::post('expencecolums-expencees', ['as' => 'admin.expenceesexpencecolums.expencecolums', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@expencecolums']);

    Route::get('filter-expence', ['as' => 'admin.expenseFilter.filter', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@filter']);
    Route::get('expenceMasters/create', ['as' => 'admin.expenceMasters.create', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@create', 'middleware' => 'can:expence_create']);
    Route::post('expenceMasters/store', ['as' => 'admin.expenceMasters.store', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@store', 'middleware' => 'can:expence_create']);
    Route::get('expenceMasters/{id}', ['as' => 'admin.expenceMasters.show', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@show', 'middleware' => 'can:expence_view']);
    Route::get('expenceMasters/{id}/edit', ['as' => 'admin.expenceMasters.edit', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@edit', 'middleware' => ['can:expence_edit','role']]);
    Route::patch('expenceMasters/{id}', ['as' => 'admin.expenceMasters.update', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@update', 'middleware' => 'can:expence_edit']);
    Route::delete('expenceMasters/{id}', ['as' => 'admin.expenceMasters.destroy', 'uses' => 'App\Http\Controllers\Admin\ExpenceMasterController@destroy', 'middleware' => 'can:expence_delete']);

    //income related Route
    Route::get('/get-batch', [App\Http\Controllers\Admin\IncomeController::class, 'getBatch'])->name('get-batch');
    Route::get('/get-trainer', [App\Http\Controllers\Admin\IncomeController::class, 'getTrainer'])->name('get-trainer');
    Route::get('table/status/{table_id}/{table_name}/{status}',function ($table_id,$table_name,$status){
        changeTableStatus($table_id,$table_name,$status);
        return redirect()->back()->with('success','Status Updated Successfully');
    })->name('table.status');
});

