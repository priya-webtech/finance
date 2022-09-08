{{--<div class="modal" tabindex="-1" role="dialog" id="roleAdd">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">Add New Role</h5>--}}
{{--                <button type="button" class="close modalClose" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
                {{ Form::open(['route' => 'role.store','method' => 'post']) }}
                <div class="form-group">
                    <label class="form-label">Role Title</label>
                    {{ Form::text('name', old('name'), ['class' => 'form-control','id' => 'role-title', 'placeholder' => 'Role Title', 'required']) }}
                </div>
{{--                <label class="form-label">Status</label>--}}
{{--                <div class="form-check">--}}
{{--                    {{ Form::radio('status', '1',old('status'), ['class' => 'form-check-input', 'id' => 'roleassigned']) }}--}}
{{--                    <label class="form-check-label" for="roleassigned">yes</label>--}}
{{--                </div>--}}
{{--                <div class="mb-3 form-check">--}}
{{--                    {{ Form::radio('status', '0',old('status'), ['class' => 'form-check-input', 'id' => 'rolenotassigned']) }}--}}
{{--                    <label class="form-check-label" for="rolenotassigned">no</label>--}}
{{--                </div>--}}

                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                <button type="button"  class="btn btn-danger modalClose" data-bs-dismiss="modal">Cancel</button>
                {{ Form::close() }}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}




