<p><?php $account = $user->account();?> </p>
<div class="col-xs-8">
  <div class="table-responsive">
    <table class="table">
      <tbody>
      <tr>
        <th style="width:50%">Currency</th>
        <td>{{$account->currency}} </td>
      </tr>
      <tr>
        <th>Account Name</th>
        <td>{{$account->account_name}}</td>
      </tr>
      <tr>
        <th>Available Balance</th>
        <td>{{ number_format($account->avaiable_balance,2,',','.') }}</td>
      </tr>
      <tr>
        <th>Current Balance</th>
        <td>{{ number_format($account->current_balance,2,',','.')}}</td>
      </tr>
    </tbody>
    </table>
  </div>
</div>