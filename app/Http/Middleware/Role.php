<?php

namespace App\Http\Middleware;

use App\Models\CallTask;
use App\Models\Campaign;
use App\Models\EmployeeRegDetail;
use App\Models\ReviewSetting;
use App\Models\User;
use Closure;
use App\Models\Admin\Trainer;
use App\Models\Admin\Corporate;
use App\Models\Admin\Course;
use App\Models\Admin\Income;
use App\Models\Admin\ExpenceMaster;
use App\Models\Admin\Batch;
use App\Repositories\Admin\TrainerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{

    public function handle(Request $request, Closure $next)
    {
        $auth=Auth::user();
        $bypass = false;
        if ($auth->hasRole('super_admin') || $auth->hasRole('admin')) {
            return $next($request);
        }
        if ($request->route('id') && $auth->hasRole('branch_manager')) {
            $slug = $request->segment(2);
            $id = $request->route('id');
            switch ($slug) {
                case "users":
                    $modal = User::class;
                    $entity = $modal::where('branch_id',$auth->branch_id)->where('id',$id)->first();
                    if ($auth->id == $id){
                        $bypass = true;
                    }
                    break;
                case "trainers":
                    $modal = Trainer::class;
                    $entity = $modal::where('branch_id',$auth->branch_id)->where('id',$id)->first();
                    break;
                case "corporates":
                    $modal = Corporate::class;
                    $entity=$modal::where('branch_id',$auth->branch_id)->where('id',$id)->first();
                    break;
                case "courses":
                    $modal = Course::class;
                    $entity=$modal::where('branch_id',$auth->branch_id)->where('id',$id)->first();
                    break;
                case "batches":
                    $modal = Batch::class;
                    $coureid=$modal::where('id',$id)->first();
                    $entity=Course::whereIn('branch_id',$auth->branch_id)->where('branch_id',$coureid->course_id)->first();
                    break;
                case "incomes":
                    $modal = Income::class;
                    $entity=$modal::where('branch_id',$auth->branch_id)->where('id',$id)->first();
                    break;
                case "expenceMasters":
                    $modal = ExpenceMaster::class;
                    $entity=$modal::where('branch_id',$auth->branch_id)->where('id',$id)->first();
                    break;
                default:
                    $entity='';
            }


            if (empty($entity) && $bypass==false) {
                abort(401);
            }
        }
//dd($request);
//        if ($auth->hasRole('admin') && $request->route()->getName() == "admin.users.edit"){
//
//           return $next($request);
//        }
//        if ($auth->hasRole('admin') && $request->route()->getName() == "admin.trainers.edit"){
//
//           return $next($request);
//        }
//        if ($auth->hasRole('admin') && $request->route()->getName() == "admin.corporates.edit"){
//
//           return $next($request);
//        }
//        if ($auth->hasRole('admin') && $request->route()->getName() == "admin.courses.edit"){
//
//           return $next($request);
//        }
//        if ($auth->hasRole('admin') && $request->route()->getName() == "admin.batches.edit"){
//
//           return $next($request);
//        }
//        if ($auth->hasRole('admin') && $request->route()->getName() == "admin.incomes.edit"){
//
//           return $next($request);
//        }
//        if ($auth->hasRole('admin') && $request->route()->getName() == "admin.expenceMasters.edit"){
//
//           return $next($request);
//        }


        return $next($request);
     }

}
