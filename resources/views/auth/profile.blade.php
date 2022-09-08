@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @include('flash-message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset('admin/images/user-icon.png')}}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{$auth->Name}}</h3>
                            <p class="text-muted text-center">Super Admin</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Mobile No</b> <a class="float-right" href="tel:7046222422">{{$auth->mobile_no}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{$auth->email}}</a>
                                </li>
{{--                                <li class="list-group-item">--}}
{{--                                    <b>City</b> <a class="float-right">Mumbai</a>--}}
{{--                                </li>--}}
                            </ul>

                        </div>

                    </div>


                </div>

                <div class="col-md-9">
                    <div class="card card-warning card-outline">
                        <div class="card-header p-2  ">

                            <i class="fas fa-edit"></i> <b>Update
                                Profile</b>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" onclick="profile()" data-toggle="tab">Genral</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" onclick="changePass()" data-toggle="tab">Change Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <form class="" action="{{route('profile-update')}}" method="post">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="inputName"
                                                           value="{{$auth->name}}" name="name"
                                                           placeholder="Name">
                                                    <span class="error text-danger">{{ $errors->first('name') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" value="{{$auth->mobile_no}}"
                                                           name="mobile_no" placeholder="Mobile Number">
                                                    <span class="error text-danger">{{ $errors->first('mobile_no') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" value="{{$auth->email}}"
                                                           name="email"  placeholder="Email">
                                                    <span class="error text-danger">{{ $errors->first('email') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Update
                                                            Profile</label>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="text" class="form-control" value="mumbai"--}}
{{--                                                           placeholder="City">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="password" class="form-control"--}}
{{--                                                           placeholder="Old Password">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="password" class="form-control"--}}
{{--                                                           placeholder="New Password">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="password" class="form-control"--}}
{{--                                                           placeholder="Comfirm Password">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}


                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-warning shadow-sm">
                                                        <b>Submit</b></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-content" id="tab_2" style="display: none">
                                    <form class="" action="{{route('change-password')}}" method="post">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="current_password"
                                                           placeholder="Old Password">
                                                    <span class="error text-danger">{{ $errors->first('current_password') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="new_password"
                                                           placeholder="New Password">
                                                    <span class="error text-danger">{{ $errors->first('new_password') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="conform_password"
                                                           placeholder="Comfirm Password">
                                                    <span class="error text-danger">{{ $errors->first('conform_password') }}</span>
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-warning shadow-sm">
                                                        <b>Submit</b></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
@push('page_scripts')
    <script>
        function changePass() {
            $('#tab_2').show();
            $('#tab_1').hide();
        }
        function profile() {
            $('#tab_1').show();
            $('#tab_2').hide();
        }
    </script>

    @endpush

