<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rule\CurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $auth = Auth::user();
        return view('auth.profile',compact('auth'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
        ]);
        $input = $request->all();
        $user = User::findorfail(Auth::id());
        $user->update($input);
        return redirect()->back()->with('success','Record Updated SuccessFully!..');
    }

    public function changePassword(Request $request)
    {
        {
            $user = User::whereId(Auth::id())->first();

            $request->validate([
                'current_password' => ['required', new CurrentPassword($user->password)],
                'new_password' => 'required|min:6',
                'conform_password' => 'required|same:new_password'
            ]);


            $new_pass['password'] = Hash::make($request->input('new_password'));
            $user->update($new_pass);

            return redirect()->back()->with('success','Password Change SuccessFully!..');
        }
    }
}
