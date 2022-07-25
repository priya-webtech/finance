<div class="container">
    <h4>Balance Verify</h4>
    <table class="table" style="width: 96%">
        <thead>
        <tr>
            <th>Bank Name</th>
            <th>Current Balance</th>
            <th>New Balance After Verify</th>
        </tr>
        </thead>
        <tbody>

        <tr class="table-warning">
            <td>{{$bankAcc->name}}</td>
            <td>{{$bankAcc->opening_balance}}</td>
            <td>{{$bankAcc->remain_balance}}</td>
        </tr>
       @foreach($allbank as $bank)
        <tr class="table-info">
            <td>{{$bank->name}}</td>
            <td>{{$bank->opening_balance}}</td>
            <td>{{$bank->opening_balance}}</td>
        </tr>
           @endforeach
        </tbody>
    </table>
</div>
