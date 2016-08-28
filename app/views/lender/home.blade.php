@extends('layouts.dashboard')
@section('content')

  <section class="content-header">
  <h1>
    Lender's page
    <small> loans that need funding...</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Lender's page</a></li>
    
  </ol>
</section>
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
                    <td> <span class='text-yellow'><i class="fa fa-star" aria-hidden="true"></i>
</span>{{  $loan->user->name() }}

                      

                    </td>
                    <td>{{  $loan->formatted_amount($loan->lenders->count() == 0 ? null : $loan_amount)  }} </td>
                    <td class='term-col'>{{  $loan->term }}  </td>
                    <td>{{  $loan->created_at->toFormattedDateString() }}</td>                  
                    <td>{{  $loan->lenders->sum('amount') == $loan->amount ? 'complete' : 'incomplete' }}</td>                  
                    <td>        
                      <?php
                        //check if this user already pledged on this loan
                        $enable_input = true;
                        $uloan =$loan->lenders()->where('loan_id',$loan->id)->where('lender_id',Auth::user()->id)->first();

                        if(!empty($uloan)){                          
                          //var_dump((int)$uloan->lender_id == Auth::user()->id);
                          //do not allow them to input amount
                          $enable_input = false;!$uloan->lender_id == Auth::user()->id;

                        }
                        //$enable_input = empty($loan_amount) ? false : $enable_input;

                      ?>
                      @if($enable_input && !empty($loan_amount))  
                     
                      <input class="amount_spinner" 
                        data-loan_id="{{$loan->id}}" 
                        data-target="#earnings-{{$loan->id}}" 
                        data-term='{{$loan->term}}' 
                        id="amount_slider-{{$loan->id}}" 
                        data-max='{{ $loan_amount }}' 
                        data-min='0' 
                      ><br/>
                      <span class='text-normal text-muted' style='font-weight:normal;font-size:x-small;'>
                        PHP {{ $loan->formatted_amount($loan_amount)}}
                      </span>
                      @else

                        <span class='text-normal text-success'>
                          {{ !empty($uloan) ? $loan->formatted_amount($uloan->amount) : ''}}
                        </span>
                      @endif

                    </td>
                    <td>
                      @if($enable_input)
                      <span class='text-primary' id="earnings-{{$loan->id}}">  
                      </span>
                      @else
                        <span class='text-success' > 
                        {{ $loan->formatted_amount($loan->compute_earning($uloan->amount)) }}
                        </span>
                      @endif
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