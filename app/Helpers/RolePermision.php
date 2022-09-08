<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use DB;
class RolePermision {
    
    public static function user_permission($permission_name,$role_id)

    { 


        $user = Auth::user();

        $user_type = $user->type;

        if($user_type == "super_admin" || $user_type == "admin"){

            return 1;

        }

         $res = DB::table('permissions')->where(['name'=>$permission_name])->first();
        

        $result = DB::table('role_has_permissions')->where(['permission_id'=>$res->id,'role_id'=>$role_id])->first();
        
        if(!empty($result))

        {

            return 1;

        }

        return 0;

    }

  
}
