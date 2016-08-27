@extends('layouts.admin')
@section('content')
<section class='content'>
  <div class='row'>
    <div class='col-md-8'>
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Loan Applications</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Borrower</th>
                    <th>Amount</th>
                    <th>Term (months)</th>
                    <th>Status</th>                  
                    <th>Date Applied</th>                  
                  </tr>
                  <?php
                  $loans = Loan::all();
                  ?>
                  @foreach($loans as $loan)
                    <tr>
                    <td>{{ $loan->user->credit_score() }}{{  $loan->user->name() }}</td>
                    <td>{{  $loan->formatted_amount() }} </td>
                    <td>{{  $loan->term }} </td>
                    <td>{{  $loan->status }}</td>                  
                  </tr>
                  @endforeach

                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>












      
    </div>
    <div class='col-md-4'>
      
    </div>
  </div>
  <div class='row'>
    <div class='col-md-12'>
      
      <div class='col-md-4'>


      </div>

    </div>
  </div>
</section>
@stop