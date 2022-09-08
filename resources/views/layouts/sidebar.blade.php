<aside class="main-sidebar elevation-4 sidebar-dark-warning">
{{--    <aside class="main-sidebar elevation-4 sidebar-dark-lightblue">--}}
    <a href="{{ url('/home') }}" class="brand-link">
        <img src="{{asset('admin/images/admin-logo.png')}}"
             alt="{{ config('app.name') }} Logo"
             class="brand-image elevation-3" style="width: 213px;">
{{--             class="brand-image img-circle elevation-3">--}}
{{--        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>--}}
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admin/images/user-icon.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>
