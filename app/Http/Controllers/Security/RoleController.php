<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //code here
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data = $request->all();
//        $permission = Permission::get();
        $view = view('admin.role-permission.form-role')->render();
        return response()->json(['data' =>  $view, 'status'=> true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);
//        dd($request->all());
        $role = Role::create(['name' => $request->input('name')]);
        return redirect()->back()->with('success','Role Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //code here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = Role::findorfail($id);
        $view = view('admin.role-permission.edit-form-role',compact('role'))->render();
        return response()->json(['data' =>  $view, 'status'=> true]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,

        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
//        $role->title = $request->input('title');
//        $role->status = $request->input('status');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->back()
            ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $role = Role::findorfail($id);
         $role->delete();
        return redirect()->back()->withSuccess(__('Role Deleted SuccessFully'));
    }
}
