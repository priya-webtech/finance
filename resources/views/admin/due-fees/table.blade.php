
@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush
{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}
@push('third_party_scripts')
{{--    <script src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>--}}
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush
