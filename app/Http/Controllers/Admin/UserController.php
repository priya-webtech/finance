<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateStudentRequest;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Models\Admin\Batch;
use App\Models\Admin\Branch;
use App\Models\Admin\EnquiryType;
use App\Models\Admin\LeadSources;
use App\Models\Admin\StudentType;
use App\Models\User;
use App\Models\Admin\columnManage;
use App\Models\VendorDetail;
use App\Repositories\Admin\StudentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Response;
use Spatie\Permission\Models\Role;

class UserController extends AppBaseController
{
    /** @var StudentRepository $studentRepository*/
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the Student.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $auth =Auth::user();
        if($auth->hasRole('super_admin') || $auth->hasRole('admin')){
            $users = User::where('role_id','!=',0)->paginate(10);
        }else{
            $users = User::where('role_id','!=',0)->where('branch_id',$auth->branch_id)->paginate(10);
        }
        $columnManage = columnManage::where('table_name','user')->where('role_id',auth()->user()->role_id)->first();
        $field = [];
        if($columnManage){
            $field = json_decode($columnManage->field_status);
        }
        return view('admin.users.index',compact('field'))->with('users', $users);
    }

    public function usercolums(Request $request)
    {
        $columnManage = columnManage::where('table_name',$request->user)->where('role_id',auth()->user()->role_id)->first();

        if($columnManage){

            $field = json_decode($columnManage->field_status);
            $storejson = array(
                'user_col_1' => ($request->user_col_1) ? 1 : null,
                'user_col_2' => ($request->user_col_2) ? 1 : null,
                'user_col_3' => ($request->user_col_3) ? 1 : null,
                'user_col_4' => ($request->user_col_4) ? 1 : null,
                'user_col_5' => ($request->user_col_5) ? 1 : null,
                'user_col_6' => ($request->user_col_6) ? 1 : null,
                'user_col_7' => ($request->user_col_7) ? 1 : null,
                'user_col_8' => ($request->user_col_8) ? 1 : null,
            );

            columnManage::where('id', $columnManage['id'])->update(
                [
                'table_name' => $columnManage['table_name'],
                'field_status' => json_encode($storejson),
                'role_id' => $columnManage['role_id'],
                ]

            );

        }else{
            $storejson = array('user_col_1' => $request->user_col_1,'user_col_2' => $request->user_col_2,'user_col_3' => $request->user_col_3,'user_col_4' => $request->user_col_4,'user_col_5' => $request->user_col_5,'user_col_6' => $request->user_col_6,'user_col_7' => $request->user_col_7,'user_col_8' => $request->user_col_8 );

             columnManage::insert([
                'table_name' => $request->user,
                'field_status' => json_encode($storejson),
                'role_id' => auth()->user()->role_id,
             ]);

        }
    }
    /**
     * Show the form for creating a new Student.
     *
     * @return Response
     */
    public function create()
    {
      $auth = Auth::user();
        if(Auth::user()->role_id == 3){
             $role = Role::where('name','!=','super_admin')->where('name','!=','admin')->where('name','!=','branch_manager')->pluck('name','id');
        }else{
             $role = Role::where('name','!=','super_admin')->pluck('name','id');
        }
        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');
      return view('admin.users.create',compact('role','branch'));
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param CreateStudentRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $input = $request->all();

        $role = Role::findorfail($input['role_id']);
        if ($role){
            $input['status'] = 1;
            $input['role_id'] = $role->id;
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $user->assignRole($role->name);
        }
        Flash::success('User saved successfully.');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified Student.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $users = User::find($id);

        if (empty($users)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        return view('admin.users.show')->with('users', $users);
    }

    /**
     * Show the form for editing the specified Student.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $auth = Auth::user();
        $users = User::findorfail($id);

        if (empty($users)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        $users->password = ' ';
        if(Auth::user()->role_id == 3){
            dd('hello');
             $role = Role::where('name','!=','super_admin')->where('name','!=','admin')->where('name','!=','branch_manager')->pluck('name','id');
        }else{
             $role = Role::where('name','!=','super_admin')->pluck('name','id');
        }

        $branch = Branch::where(function ($query) use ($auth) {
            if ($auth->hasRole('branch_manager') || $auth->hasRole('counsellor') || $auth->hasRole('internal_auditor') || $auth->hasRole('student_co-ordinator')) {
                $query->where('id', '=', $auth->branch_id);
            }
        })->pluck('title', 'id');
       // $branch = Branch::where('status',1)->pluck('title','id');
        return view('admin.users.edit',compact('role','users','branch'));
    }

    /**
     * Update the specified Student in storage.
     *
     * @param int $id
     * @param UpdateStudentRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {


         $users= User::find($id);

        if (empty($users)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$users->id],
        ]);
         $input = $request->all();
         if($input['password'] == null){
             $input['password'] =  $users->password;
         }else{
             $request->validate([
                 'password' => ['string', 'min:8', 'confirmed'],
             ]);
             $input['password'] = Hash::make($input['password']);
         }
         $input['branch_id'] = $input['branch_id'];
        $users = $users->update($input);

        Flash::success('Users updated successfully.');

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified Student from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $users = User::find($id);

        if (empty($users)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        $users = $users->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('admin.users.index'));
    }
}
