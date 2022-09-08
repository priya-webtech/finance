{{--{{ Form::model(['route' => 'role.update',$role->id,'method' => 'patch']) }}--}}
{!! Form::open(['route' => ['role.update',$role->id], 'method' => 'patch' ]) !!}
<div class="form-group">
    <label class="form-label">Role title</label>
    {{ Form::text('name',$role->name, ['class' => 'form-control','id' => 'role-title', 'placeholder' => 'Role Title', 'required']) }}
</div>
{{--<label class="form-label">Status</label>--}}
{{--<div class="form-check">--}}
{{--    {{ Form::radio('status', '1', old( 'status', $role->status == 1) ? 'true' : '' ,  ['class' => 'form-check-input', 'id' => 'roleassigned']) }}--}}
{{--    <label class="form-check-label" for="roleassigned">yes</label>--}}
{{--</div>--}}
{{--<div class="mb-3 form-check">--}}
{{--    {{ Form::radio('status', '0',old( 'status', $role->status == 0) ? 'true' : '' , ['class' => 'form-check-input', 'id' => 'rolenotassigned']) }}--}}
{{--    <label class="form-check-label" for="rolenotassigned">no</label>--}}
{{--</div>--}}
<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
{{ Form::close() }}
