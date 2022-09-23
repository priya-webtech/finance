<div class="table-responsive">
  <div class="custom-filter">
    <form data-action="{{ route('admin.corporateescorporatecolums.corporatecolums') }}" method="post" style="margin-top: 20px;" id="batchform">
    @csrf

    <div class="multiselect">
        <div class="selectBox" onclick="showCheckboxes()">
          <select>
            <option>Select an option</option>
          </select>
          <div class="overSelect"></div>
        </div>
        <div id="checkboxes">
          <label for="one">
            <input type="checkbox" class="corporathidecol"  name="corporat_col_1" @if(!empty($field) && $field->corporat_col_1 == 1) Checked @endif/>&nbsp;Company Name&nbsp;
          <label for="two">
            <input type="checkbox" class="corporathidecol" name="corporat_col_2" @if(!empty($field) && $field->corporat_col_2 == 1) Checked @endif/>&nbsp;Contact No
          <label for="three">
            <input type="checkbox" class="corporathidecol" name="corporat_col_3" @if(!empty($field) && $field->corporat_col_3 == 1) Checked @endif/>&nbsp;Email
          <label for="four">
            <input type="checkbox" class="corporathidecol" name="corporat_col_4" @if(!empty($field) && $field->corporat_col_4 == 1) Checked @endif/>&nbsp;Web Site
          <label for="five">
            <input type="checkbox" class="corporathidecol" name="corporat_col_5" @if(!empty($field) && $field->corporat_col_5 == 1) Checked @endif/>&nbsp;Status
          <label for="seven">
           <input type="checkbox" class="corporathidecol" name="corporat_col_6" @if(!empty($field) && $field->corporat_col_6 == 1) Checked @endif/>&nbsp;Branch
           <label for="seven">
           <input type="checkbox" class="corporathidecol" name="corporat_col_7" @if(!empty($field) && $field->corporat_col_7 == 1) Checked @endif/>&nbsp;Enquiry Type
           <label for="seven">
           <input type="checkbox" class="corporathidecol" name="corporat_col_8" @if(!empty($field) && $field->corporat_col_8 == 1) Checked @endif/>&nbsp;Lead Source
        </div>
    </div>

    <input type="hidden" name="corporat" value="corporat">
    </form>

    <input type="submit" class="btn btn-danger btn-sm batchsubmit" value="Save">


    <form action="{{ route('admin.corporatesFilter.filter') }}" method="post" style="margin-top: 20px;">
        @csrf
    <div class="form-group col-sm-6">
      {!! Form::label('enquiry_type_id', 'Enquiry Type:') !!}
      {!! Form::select('enquiry_type_id',$enquiryType, null, ['class' => 'form-control','placeholder'=>'Select Enquiry Type']) !!}
         
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('lead_source_id', 'Lead Source:') !!}
        {!! Form::select('lead_source_id',$leadsouce, null, ['class' => 'form-control','placeholder'=>'Select Lead Source']) !!}
    
    </div>
    <input type="submit" class="btn btn-danger btn-sm" value="Filter">
    <a href="{{ route('admin.corporates.index') }}">clear</a>
    </form>
  </div>
   <div class="row float-right">
        <input id="corporatesInput" type="text" class="form-control" placeholder="Search..">
    </div>
    <table class="table" id="corporates-table">
        <thead>
        <tr>
        @if(!empty($field) && $field->corporat_col_1 == 1)<th>S.No</th>@endif
        @if(!empty($field) && $field->corporat_col_1 == 1)<th>Company Name</th>@endif
        @if(!empty($field) && $field->corporat_col_2 == 1)<th>Contact No</th>@endif
        @if(!empty($field) && $field->corporat_col_3 == 1)<th>Email</th>@endif
        @if(!empty($field) && $field->corporat_col_4 == 1)<th>Web Site</th>@endif
        @if(!empty($field) && $field->corporat_col_5 == 1)<th>Status</th>@endif
        @if(!empty($field) && $field->corporat_col_6 == 1)<th>Branch</th>@endif
        @if(!empty($field) && $field->corporat_col_7 == 1)<th>Enquiry Type</th>@endif
        @if(!empty($field) && $field->corporat_col_8 == 1)<th>Lead Source</th>@endif
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($corporates) >0)
        @foreach($corporates as $key=>$corporate)
            <tr>
            @if(!empty($field) && $field->corporat_col_1 == 1)<td>{{$key + $corporates->firstItem()}}</td>@endif
            @if(!empty($field) && $field->corporat_col_1 == 1)<td>{{ $corporate->company_name }}</td>@endif
            @if(!empty($field) && $field->corporat_col_2 == 1)<td>{{ $corporate->contact_no }}</td>@endif
            @if(!empty($field) && $field->corporat_col_3 == 1)<td>{{ $corporate->email }}</td>@endif
            @if(!empty($field) && $field->corporat_col_4 == 1)<td>{{ $corporate->web_site }}</td>@endif
           @if(!empty($field) && $field->corporat_col_5 == 1)<td><span class='badge @if($corporate->status == 1)badge-success @else badge-danger @endif'>{{ $corporate->status == 1 ? "Active" : "Block" }}</span></td>@endif
            @if(!empty($field) && $field->corporat_col_6 == 1)<td>{{ $corporate->branch->title }}</td>@endif
            @if(!empty($field) && $field->corporat_col_7 == 1)<td>{{ $corporate->enquiry->title }}</td>@endif
            @if(!empty($field) && $field->corporat_col_8 == 1)<td>{{ $corporate->lead->title }}</td>@endif
                <td width="120">
                    {!! Form::open(['route' => ['admin.corporates.destroy', $corporate->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('corporates_status')
                        <a href="{{ route('table.status', [ $corporate->id,"corporates", $corporate->status]) }}" class='btn @if($corporate->status==1) btn-warning @else btn-success @endif action-btn btn-sm'>
                            <i class="fa @if($corporate->status==1) fa-ban @else fa-check @endif"></i>
                        </a>
                        @endcan
                        @can('corporates_view')
                        <a href="{{ route('admin.corporates.show', [$corporate->id]) }}"
                           class='btn btn-default action-btn btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan
                        @can('corporates_edit')
                        <a href="{{ route('admin.corporates.edit', [$corporate->id]) }}"
                           class='btn btn-primary action-btn btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        @endcan
                        @can('corporates_delete')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>

        @endforeach
            @endif
        </tbody>
    </table>
</div>
