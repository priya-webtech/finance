
{!! Form::open(['route' => ['due-fees-edit',[$id,$type]], 'method' => 'delete']) !!}

<div class='btn-group'>
    <a href="#" class='btn btn-default action-btn btn-sm'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{route('due-fees-edit',[$id,$type])}}" class='btn btn-primary action-btn btn-sm'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger action-btn btn-sm',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
