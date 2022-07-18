<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $users->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $users->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $users->email }}</p>
</div>

<!-- Mobile No Field -->
<div class="col-sm-12">
    {!! Form::label('mobile_no', 'Mobile No:') !!}
    <p>{{ $users->mobile_no }}</p>
</div>
<!-- Mobile No Field -->
<div class="col-sm-12">
    {!! Form::label('role', 'Role:') !!}
    <p>{{ $users->role->name }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $users->status == 1 ? "Active" : "Block" }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $users->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $users->updated_at }}</p>
</div>

