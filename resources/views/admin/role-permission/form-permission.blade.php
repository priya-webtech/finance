
{{--<div class="modal" tabindex="-1" role="dialog" id="peremissionAdd">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">Add Permission</h5>--}}
{{--                <button type="button" class="close modalClose" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
                {{ Form::open(['route' => 'permission.store','method' => 'post']) }}
                    <div class="form-group">
                        <label class="form-label">Permission title</label>
                        {{ Form::text('name', old('name'), ['class' => 'form-control','id' => 'permission-title', 'placeholder' => 'Permission Title', 'required']) }}
                    </div>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-danger modalClose" data-bs-dismiss="modal">Cancel</button>
                {{ Form::close() }}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


