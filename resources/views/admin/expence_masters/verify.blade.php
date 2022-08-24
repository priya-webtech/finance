<div class="container">
{{--    <h4>Balance Verify</h4>--}}
    <table class="table">
        <thead>
        <tr class="table-blue">
            <th>Bank Name</th>
            <th>Current Balance</th>
            <th>New Balance After Verify</th>
        </tr>
        </thead>
        <tbody>

        <tr class="table-dark-gray">
            <td>{{$bankAcc->name}}</td>
            <td>{{$bankAcc->opening_balance}}</td>
            <td>{{$bankAcc->remain_balance}}</td>
        </tr>
       @foreach($allbank as $bank)
        <tr class="table-gray">
            <td>{{$bank->name}}</td>
            <td>{{$bank->opening_balance}}</td>
            <td>{{$bank->opening_balance}}</td>
        </tr>
           @endforeach
        </tbody>
    </table>
</div>
