@extends('layouts.admin')
@section('content')


<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
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
              <table class="table table-striped table-condensed">
                <tbody>
                  <tr>
                    <th>Borrower</th>
                    <th>Amount</th>
                    <th class='term-col'>Term <br>(months)</th>                    
                    <th>Date</th>                  
                    <th>Status</th>                  
                    <th>Investment                      
                    </th>
                    <th>Earnings
                      <br/>
                       <span class='text-normal text-muted' style='font-weight:normal;font-size:x-small;'>
                        Your earnings after loan has been fully paid
                      </span>
                    </th>
                    <th>
                    </th>
                  </tr>
                  <?php
                  $loans = Loan::all();
                  ?>
                  @foreach($loans as $loan)
                     <?php
                        //does this loan already have lenders?                        

                        //get the total sum of the amount and replace the original one
                        $loan_amount  = $loan->lenders->count() > 0 ? $loan->amount - $loan->lenders->sum('amount') : $loan->amount / 2;

                      ?>
                    <tr>
                    <td>   {{ $loan->user->credit_score() }} {{  $loan->user->name() }}</td>
                    <td>{{  $loan->formatted_amount($loan->lenders->count() == 0 ? null : $loan_amount)  }} </td>
                    <td class='term-col'>{{  $loan->term }}  </td>
                    <td>{{  $loan->created_at->toFormattedDateString() }}</td>                  
                    <td>{{  $loan->status }}</td>                  
                    <td>        

                     
                      <input class="amount_spinner" 
                        data-loan_id="{{$loan->id}}" 
                        data-target="#earnings-{{$loan->id}}" 
                        data-term='{{$loan->term}}' 
                        id="amount_slider-{{$loan->id}}" 
                        data-max='{{ $loan_amount }}' 
                        data-min='0' 
                      ><br/>
                      <span class='text-normal text-muted' style='font-weight:normal;font-size:x-small;'>
                        max: {{ $loan->formatted_amount($loan_amount)}}
                      </span>

                    </td>
                    <td>
                      <span class='text-primary' id="earnings-{{$loan->id}}">  
                      </span>
                    </td>
                    <td>
                      <button class='btn btn-xs btn-default hidden picker'>pick</button>
                    </td>
                    
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

@section('scripts')
 {{ HTML::script("js/lender.js") }}
@stop

<style type='text/css'>
.term-col{ text-align:center; }
</style>