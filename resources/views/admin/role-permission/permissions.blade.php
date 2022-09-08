@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role & Permission</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash-message')
        <div class="card">
   <div class="row">
      <div class="col-sm-12">
{{--         <div class="card">--}}
            <div class="card-header">
               <div class="header-title">
                  <h4 class="card-title mb-0">Role & Permission</h4>
               </div>
               <div class="float-right">
                    <a href="#" id="add_per" class="btn btn-warning shadow-sm float-right" data-bs-toggle="tooltip" data-modal-form="form" data-icon="person_add" data-size="small" data--href="{{ route('permission.create') }}" data-app-title="Add new permission" data-placement="top" title="New Permission">
                        <span>New Permission</span>
                    </a>
                    <a href="#" id="add_role" class="btn btn-warning shadow-sm float-right" data-bs-toggle="tooltip" data-modal-form="form" data-icon="person_add" data-size="small" data--href="{{ route('role.create') }}" data-app-title="Add new role" data-placement="top" title="New Role" style="margin-right: 7px;">
                        <span>New Role</span>
                    </a>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{ Form::open(['route' => 'role.permission.store','method' => 'POST']) }}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    @foreach ($roles as $role)
                                        <th class="text-center">{{ $role->name }}
                                        <div style="float:right;">
{{--                                            <form action="{{ route('role.destroy',$role->id) }}" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
                                            <a href="#" class="mt-lg-0 mt-md-0 mt-3 btn-icon" data-bs-toggle="tooltip" data-modal-form="form" data-icon="person_add" data-size="small" data--href="{{ route('role.edit',$role->id) }}" data-app-title="Edit role" data-placement="top" title="Edit Role" method="GET">
                                            <span class="btn-inner">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                                                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            </a>

                                        <a  class="btn btn-sm btn-icon text-danger"  data-bs-toggle="tooltip" title="Delete User" href="{{route('role-delete',$role->id)}}">
                                            <span class="btn-inner">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </a>

                                        </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr class="{{ !isset($permission->parent_id) ? 'bg-body' : '' }}">
                                    <td>{{ $permission->name }}
                                    <div style="float:right;">
{{--                                        <form action="{{ route('permission.destroy',$permission->id) }}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
                                            <a href="#" class="mt-lg-0 mt-md-0 mt-3 btn-icon" data-bs-toggle="tooltip" data-modal-form="form" data-icon="person_add" data-size="small" data--href="{{ route('permission.edit',$permission->id) }}" data-app-title="Edit Permission" data-placement="top" title="Edit Permission" method="GET">
                                            <span class="btn-inner">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                                                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            </a>
                                    <a  class="btn btn-sm btn-icon text-danger "  data-bs-toggle="tooltip" title="Delete User" href="{{route('permission-delete',$permission->id)}}">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>
{{--                                        </form>--}}
                                    </div>
                                    </td>
                                    @foreach ($roles as $role)
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" id="role-{{$role->id}}-permission-{{$permission->id}}" name="permission[{{$permission->id}}][]" value='{{$role->id}}'
                                            {{ (\App\Helpers\AuthHelper::checkRolePermission($role,$permission->name)) ? 'checked' : '' }}>
                                        </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                        {{ Form::submit( __('Save'), ['class'=>'btn btn-md btn-warning','onclick'=>"$(this).closest('form').submit()"]) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
{{--         </div>--}}
      </div>
   </div>
   </div>

</div>
    <div class="modal" tabindex="-1" role="dialog" id="editper">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formTitle">Edit Permission</h5>
                    <button type="button" class="close modalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body main_form">

                </div>

            </div>
        </div>
    </div>
@endsection
@push('third_party_scripts')
<script>
    $(document).on('click', '[data-modal-form="form"]', function () {

        $("#formModal input ,#formModal select,#formModal textarea").prop("disabled", false);
        var app_title = $(this).attr('data-app-title');
        var app_size = $(this).attr('data-size');
        var app_icon = $(this).attr('data-icon');
        var url = $(this).attr('data--href');
        var render = $(this).attr('data-render');
        var _this = $(this);
        openModal(app_title,app_size,app_icon,url,render,_this);
    });

    function openModal(app_title = '',app_size,app_icon = 'assignment',url,render,_this){

        if (_this !== undefined){
            if(_this.attr('data-custom-icon') === 'font_icon'){
                $('.card-icon').html('<i class="'+_this.attr('data-icon-class')+'"></i>');
            }
        }

        if (app_size === 'small')
        {
            $('.modal-dialog').removeClass('modal-extra-large modal-lg')
        }else{
            $('.modal-dialog').addClass('modal-extra-large modal-lg')
        }

        $.get(url, function (data) {

            var html = data.data;
            console.log(html,data)
            if (render !== undefined && render !== '' && render !== null){

                $('.'+render).html(html);
            } else{
                console.log(data);
                $(".main_form").html(html);
                $("#formTitle").empty().append(app_title);
                $("#form-icon").html(app_icon);
                $("#editper").modal("show");
            }
            // setTimeout(function () {
            //     if (_this.attr('data-plugin-init') !== 'false'){
            //         pluginInti();
            //     }
            // },200);
        });
    }
</script>
    @endpush
