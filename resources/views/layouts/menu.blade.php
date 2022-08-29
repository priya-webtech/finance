@php
  $auth = \Illuminate\Support\Facades\Auth::user();
@endphp
<li class="nav-item ">
    <a href="{{url('home')}}" class="nav-link {{ \Illuminate\Support\Facades\Request::is('admin/dashboard*') ? 'active' : ''}} ">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
@can('history_view')
<li class="nav-item">
    <a href="{{route('history')}}" class="nav-link {{ \Illuminate\Support\Facades\Request::is('admin/history*') ? 'active' : ''}} ">
        <i class="nav-icon fa fa-history" aria-hidden="true"></i>
        <p>History</p>
    </a>
</li>
@endcan
@if($auth->hasRole('super_admin') || $auth->hasRole('admin'))
<li class="nav-item ">
    <a href="{{route('role.permission.list')}}" class="nav-link {{ \Illuminate\Support\Facades\Request::is('admin/role-permission*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-lock"></i>
        <p>Role-Permission</p>
    </a>
</li>
@endif
@can('user_view')
<li class="nav-item">
    <a href="{{ route('admin.users.index') }}"
       class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-user-circle"></i>
        <p>User</p>
    </a>
</li>
@endcan

@can('trainers_view')
<li class="nav-item">
    <a href="{{ route('admin.trainers.index') }}"
       class="nav-link {{ Request::is('admin/trainers*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-user" aria-hidden="true"></i>
        <p>Trainers</p>
    </a>
</li>
@endcan
@can('corporates_view')
<li class="nav-item">
    <a href="{{ route('admin.corporates.index') }}"
       class="nav-link {{ Request::is('admin/corporates*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-address-card" aria-hidden="true"></i>
        <p>Corporates</p>
    </a>
</li>
@endcan
@can('students_view')
<li class="nav-item">
    <a href="{{ route('admin.students.index') }}"
       class="nav-link {{ Request::is('admin/students*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-users" aria-hidden="true"></i>
        <p>Registered Students</p>
    </a>
</li>
@endcan
@can('due_fees_view')
<li class="nav-item">
    <a href="{{route('due-fees')}}"
       class="nav-link {{ Request::is('admin/due-fees*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-file" aria-hidden="true"></i>
        <p>Due Fees</p>
    </a>
</li>
@endcan
@can('courses_view')
<li class="nav-item">
    <a href="{{ route('admin.courses.index') }}"
       class="nav-link {{ Request::is('admin/courses*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-book" aria-hidden="true"></i>
        <p>Courses</p>
    </a>
</li>
@endcan



@can('batches_view')
<li class="nav-item">
    <a href="{{ route('admin.batches.index') }}"
       class="nav-link {{ Request::is('admin/batches*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-tasks" aria-hidden="true"></i>
        <p>Batches</p>
    </a>
</li>
@endcan
@can('incomes_view')
<li class="nav-item">
    <a href="{{ route('admin.incomes.index') }}"
       class="nav-link {{ Request::is('admin/incomes*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-circle" aria-hidden="true"></i>
        <p>Incomes</p>
    </a>
</li>
@endcan
@can('expence_view')
<li class="nav-item">
    <a href="{{ route('admin.expenceMasters.index') }}"
       class="nav-link {{ Request::is('admin/expenceMasters*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-credit-card" aria-hidden="true"></i>
        <p>Expense</p>
    </a>
</li>
@endcan

{{--<li class="nav-header">PAGES</li>--}}
@if($auth->hasRole('super_admin') || $auth->hasRole('admin'))
<li class="nav-header">SYSTEM SETTING</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fa fa-cog" aria-hidden="true"></i>
        <p>
            Settings
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('admin.leadSources.index') }}"
               class="nav-link {{ Request::is('admin/leadSources*') ? 'active' : '' }}">
                <i class="fa fa-cube" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Lead Sources</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.enquiryTypes.index') }}"
               class="nav-link {{ Request::is('admin/enquiryTypes*') ? 'active' : '' }}">
                <i class="fa fa-crosshairs" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Enquiry Types</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.expenseTypes.index') }}"
               class="nav-link {{ Request::is('admin/expenseTypes*') ? 'active' : '' }}">
                <i class="fa fa-hourglass" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Expense Types</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.incomeTypes.index') }}"
               class="nav-link {{ Request::is('admin/incomeTypes*') ? 'active' : '' }}">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Income Types</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.studentTypes.index') }}"
               class="nav-link {{ Request::is('admin/studentTypes*') ? 'active' : '' }}">
                <i class="fa fa-address-book" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Student Types</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.franchises.index') }}"
               class="nav-link {{ Request::is('admin/franchises*') ? 'active' : '' }}">
                <i class="fa fa-asterisk" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Franchises</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.branches.index') }}"
               class="nav-link {{ Request::is('admin/branches*') ? 'active' : '' }}">
                <i class="fa fa-recycle" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Branches</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.modeOfPayments.index') }}"
               class="nav-link {{ Request::is('admin/modeOfPayments*') ? 'active' : '' }}">
                <i class="fa fa-university" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Mode Of Payments</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.batchTypes.index') }}"
               class="nav-link {{ Request::is('admin/batchTypes*') ? 'active' : '' }}">
                <i class="fa fa-compass" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Batch Types</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.revenueTypes.index') }}"
               class="nav-link {{ Request::is('admin/revenueTypes*') ? 'active' : '' }}">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Revenue Types</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.batchModes.index') }}"
               class="nav-link {{ Request::is('admin/batchModes*') ? 'active' : '' }}">
                <i class="fa fa-check-square" aria-hidden="true"></i>
                <p>&nbsp;&nbsp;Batch Modes</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.settings.index') }}"
               class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <p>Settings</p>
            </a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('admin.bankAccounts.index') }}"--}}
{{--               class="nav-link {{ Request::is('admin/bankAccounts*') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-university" aria-hidden="true"></i>--}}
{{--                <p>Bank Accounts</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('admin.trainerFreeSlabs.index') }}"--}}
{{--               class="nav-link {{ Request::is('admin/trainerFreeSlabs*') ? 'active' : '' }}">--}}
{{--                <p>Trainer Fee Slabs</p>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</li>

@endif

