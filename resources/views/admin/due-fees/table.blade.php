
@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush
<form data-action="{{ route('due_feesesdue_feescolums.due_feescolums') }}" method="post" style="margin-top: 20px;" id="batchform">
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
            <input type="checkbox" class="due_feeshidecol"  name="due_fees_col_1" @if(!empty($field) && $field->due_fees_col_1 == 1) Checked @endif/>&nbsp; Name&nbsp;
          <label for="two">
            <input type="checkbox" class="due_feeshidecol" name="due_fees_col_2" @if(!empty($field) && $field->due_fees_col_2 == 1) Checked @endif/>&nbsp;Email
          <label for="three">
            <input type="checkbox" class="due_feeshidecol" name="due_fees_col_3" @if(!empty($field) && $field->due_fees_col_3 == 1) Checked @endif/>&nbsp;Course name
          <label for="three">
            <input type="checkbox" class="due_feeshidecol" name="due_fees_col_4" @if(!empty($field) && $field->due_fees_col_4 == 1) Checked @endif/>&nbsp;due date
          <label for="three">
            <input type="checkbox" class="due_feeshidecol" name="due_fees_col_5" @if(!empty($field) && $field->due_fees_col_5 == 1) Checked @endif/>&nbsp;Agreed Amount
          <label for="three">
            <input type="checkbox" class="due_feeshidecol" name="due_fees_col_6" @if(!empty($field) && $field->due_fees_col_6 == 1) Checked @endif/>&nbsp;Pay Amount
          <label for="three">
            <input type="checkbox" class="due_feeshidecol" name="due_fees_col_7" @if(!empty($field) && $field->due_fees_col_7 == 1) Checked @endif/>&nbsp;Gst
          <label for="three">
            <input type="checkbox" class="due_feeshidecol" name="due_fees_col_8" @if(!empty($field) && $field->due_fees_col_8 == 1) Checked @endif/>&nbsp;Due fees
          <label for="three">
            <input type="checkbox" class="due_feeshidecol" name="due_fees_col_9" @if(!empty($field) && $field->due_fees_col_9 == 1) Checked @endif/>&nbsp;Type

          
        </div>
    </div>

    <input type="hidden" name="due_fees" value="due_fees">
    </form>
    <input type="submit" class="btn btn-danger btn-sm batchsubmit" value="Save">
{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}
@push('third_party_scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush
