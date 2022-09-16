<div class="table-responsive">
    <input id="modeOfPaymentsInput" class="form-control" type="text" placeholder="Search..">
    <table class="table" id="modeOfPayments-table">
        <thead>
        <tr>
            <th>Title</th>
{{--            <th>Name</th>--}}
{{--            <th>IFSC Code</th>--}}
{{--            <th>Account No</th>--}}
            <th>Balance</th>
        
        </tr>
        </thead>
        <tbody>

        @foreach($modeOfPayments as $modeOfPayment)
{{--            @dd($modeOfPayment)--}}
            <tr>
                <td>{{ $modeOfPayment->title }}</td>
{{--                <td>{{ $modeOfPayment->name }}</td>--}}
{{--                <td>{{ $modeOfPayment->ifsc_code }}</td>--}}
{{--                <td>{{ $modeOfPayment->account_no }}</td>--}}
                <td>{{ $modeOfPayment->opening_balance }}</td>
               
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
