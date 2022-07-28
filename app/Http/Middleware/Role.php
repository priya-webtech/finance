<?php

namespace App\Http\Middleware;

use App\Models\CallTask;
use App\Models\Campaign;
use App\Models\EmployeeRegDetail;
use App\Models\ReviewSetting;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{

    public function handle(Request $request, Closure $next)
    {
        $auth=Auth::user();
       $bypass = false;
        if ($auth->hasRole('super-admin') ) {
            return $next($request);
        }

        if ($request->route('id') && $auth->hasRole('admin')) {

            $slug = $request->segment(2);
    
            $id = $request->route('id');
            switch ($slug) {
                case "users":
              
                    $modal = User::class;
                    $entity = $modal::whereJsonContains('branch_id',$auth->branch_id)->where('id',$id)->first();
                    if ($auth->id == $id){
                        $bypass = true;
                    }
                    break;
                case "campaign":
                    $modal = Campaign::class;
                    $entity=$modal::where('vendor_id',Auth::id())->where('id',$id)->first();
                    break;
                case "review":
                    $modal = ReviewSetting::class;
                    $entity=$modal::where('vendor_id',Auth::id())->where('id',$id)->first();

                    break;
                case "call-task":
                    $modal = Campaign::class;
                    $camp =$modal::where('vendor_id',Auth::id())->pluck('id');
                    $entity = CallTask::where('id',$id)->whereIn('campaign_id',$camp)->first();
                    break;
                default:
                    $entity='';
            }

            if (empty($entity) && $bypass==false) {
                abort(401);
            }
        }
           
        if ($auth->hasRole('admin') && $request->route()->getName() == "admin.users.edit"){

           // dd($next($request));
          //  return redirect()->route('admin.users.edit',$entity->id)->withErrors('Your Plan is expired please update');
        }


        return $next($request);
     }

}
