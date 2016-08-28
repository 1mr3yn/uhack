 <?php  use Carbon\Carbon; ?>
    <div class='row'>
      <div class='col-md-12'>
        <h4>Your Loan Applications</h4>
        @if(!empty($the_flash = Session::get('the_flash')))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thank you!</h4>
            {{ $the_flash}}
          </div>
        @endif
        <?php
          
          $loan = Auth::user()->loans()->first();
          $complete = $loan->lenders->sum('amount') == $loan->amount ? true : false;
        ?>
        @if(!empty($loan))
        <div class="info-box bg-aqua {{ $complete ? 'bg-green' : '' }}">
            <span class="info-box-icon"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Loan Details</span>
              
              <span class="info-box-number">Php {{ number_format($loan->amount,2)}}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 0%"></div>
              </div>
              <span class="progress-description">
                Status: {{ $complete ? "<strong>Complete</strong>" : "Incomplete" }}  |
                <?php 
                $start = Carbon::parse($loan->start_date)->toFormattedDateString();
                ?>
                Date Started : {{ $complete ? "<strong>  {$start}</strong>" : "N/A" }}  |

                Terms: <strong>{{ $loan->term }} months</strong> | Monthly installment: <strong>PHP {{ number_format($loan->compute(),2) }}</strong>
                #id:{{$loan->id}}
              </span>
            
            </div>
            <!-- /.info-box-content -->
          </div>

          @endif



      </div>

      <div classs='col-md-12'>
          @if(empty($loan->lenders->count()))
          <span class='text-muted' title= "No Lenders Yet" data-toggle="tooltip" data-placement="left" >
            <i class="fa fa-user-times" aria-hidden="true"></i>                  
          </span>
          @else
            <div style='margin:14px'>
            <?php $total_lended = 0;?>
            @foreach($loan->lenders as $key=> $lender)
              <?php $total_lended += $lender->amount; ?>
              <button class='btn btn-warning btn-lg'  title= "Lender: {{$key+1}} " data-toggle="tooltip" data-placement="top" >
                <i class="fa fa-user" aria-hidden="true"></i> | PHP {{ $loan->formatted_amount($lender->amount) }}                 
              </button>              
            @endforeach
              @if(!empty($remaining = $loan->amount - $total_lended))
              <button class='btn btn-default btn-lg' >
                <i class="fa fa-user-times" aria-hidden="true"></i> | PHP {{ $loan->formatted_amount($remaining) }}                 
              </button>              
              @endif
            </div>
          @endif
      
      </div>
              

      <div class='col-md-12'>
        @if(!empty($loan))
          <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Payment Schedule</h3>

            
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding table-striped">
            <table class="table table-hover table-striped">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Amount</th>                 
                </tr>
                <?php 
                  $total = 0;
                ?>
                @for($i=1;$i<=$loan->term;$i++)
                
                  <tr>
                  <td>{{ $i }} </td>
                  <td>{{ $loan->created_at->addMonths($i)->toFormattedDateString() }}</td>
                  <td>
                    <?php 
                      $total += $loan->compute();
                      echo $loan->formatted_amount($loan->compute());
                      ?> 
                  </td>
                  
                </tr>
                @endfor
                <tr>
                  <th></th>
                  <th></th>
                  <th><strong>{{ $loan->formatted_amount($total)}}</strong></th>                 
                </tr>

              </tbody>



            </table>
          </div>
          <!-- /.box-body -->
        </div>




        @endif
      </div>
    </div>
  
