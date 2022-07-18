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
use App\Repositories\Admin\StudentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
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
        $users = User::where('role_id','!=',constant('super_admin'))->paginate(10);
        return view('admin.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new Student.
     *
     * @return Response
     */
    public function create()
    {
      $role = Role::where('name','!=','super_admin')->pluck('name','id');
      $branch = Branch::where('status',1)->pluck('title','id');
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
        $users = User::findorfail($id);

        if (empty($users)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        $users->password = ' ';
        $role = Role::where('name','!=','super_admin')->pluck('name','id');
        $branch = Branch::where('status',1)->pluck('title','id');
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
            'password' => ['string', 'min:8', 'confirmed'],
        ]);
         $input = $request->all();
         if($input['password'] == ' '){
             $input['password'] =  $users->password;
         }else{
             $input['password'] = Hash::make($input['password']);
         }
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
