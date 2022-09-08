<?php
function removeSession($session){
    if(\Session::has($session)){
        \Session::forget($session);
    }
    return true;
}
function getIncomeType($id){

   $income = \App\Models\Admin\Income::find($id);
   return $income->incomeType->title ?? 'N/A';
}
function PayAmount($id){
    $income = \App\Models\Admin\Income::find($id);
    if($income->corporateStudFees){
        return number_format($income->corporateStudFees->gst+$income->paying_amount,2);
    }elseif($income->incomeStudFees){
        return number_format($income->incomeStudFees->gst+$income->paying_amount,2);
    }else{
        return number_format($income->gst+$income->paying_amount,2);
    }
}
function changeTableStatus($id, $table_name, $status)
{
    if ($status==1){
        $up_status=0;
    }
    else{
        $up_status=1;
    }

    $table_update = \Illuminate\Support\Facades\DB::table($table_name)->where('id', $id)->update(['status'=>$up_status]);
    return $table_update;
}
if (!function_exists('site_setting')) {
    function site_setting($key=null)
    {
        if ($key){
            $data = \App\Models\Admin\Setting::first()->$key;
            if ($data) {
                return $data;
            }
        }
        else{
            return \App\Models\Admin\Setting::first();
        }

    }

}


function checkRecordExist($table_list,$column_name,$id){
    if(count($table_list) > 0){
        foreach($table_list as $table){
            $check_data = \DB::table($table)->where($column_name,$id)->count();
            if($check_data > 0) return false ;
        }
        return true;
    }
    return true;
}

// Model file save to storage by spatie media library
//function storeMediaFile($model,$file,$name)
//{
//    if($file) {
//        $model->clearMediaCollection($name);
//        if (is_array($file)){
//            foreach ($file as $key => $value){
//                $model->addMedia($value)->toMediaCollection($name);
//            }
//        }else{
//            $model->addMedia($file)->toMediaCollection($name);
//        }
//    }
//    return true;
//}

// Model file get by storage by spatie media library
//function getSingleMedia($model, $collection = 'image_icon',$skip=true)
//{
//    if (!\Auth::check() && $skip) {
//        return asset('images/avatars/01.png');
//    }
//    if ($model !== null) {
//        $media = $model->getFirstMedia($collection);
//    }
//    $imgurl= isset($media)?$media->getPath():'';
//    if (file_exists($imgurl)) {
//        return $media->getFullUrl();
//    }
//    else
//    {
//        switch ($collection) {
//            case 'image_icon':
//                $media = asset('images/avatars/01.png');
//                break;
//            case 'profile_image':
//                $media = asset('images/avatars/01.png');
//                break;
//            default:
//                $media = asset('images/common/add.png');
//                break;
//        }
//        return $media;
//    }
//}

// File exist check
//function getFileExistsCheck($media)
//{
//    $mediaCondition = false;
//    if($media) {
//        if($media->disk == 'public') {
//            $mediaCondition = file_exists($media->getPath());
//        } else {
//            $mediaCondition = \Storage::disk($media->disk)->exists($media->getPath());
//        }
//    }
//    return $mediaCondition;
//}
