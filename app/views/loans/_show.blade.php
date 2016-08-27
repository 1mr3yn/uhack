 
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
          
        ?>
        @if(!empty($loan))
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Loan Details</span>
              <span style='float:right'><i class="fa fa-times" aria-hidden="true"></i></span>
              <span class="info-box-number">Php {{ number_format($loan->amount)}}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 0%"></div>
              </div>
              <span class="progress-description">
                Terms: {{ $loan->term }} months | Monthly installment: <strong>PHP {{ number_format($loan->compute(),2) }}</strong>
                
                <span class='text-muted' style='float:right' title='Credit Rating: 0' data-toggle="tooltip" data-placement="left"  > |
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <i class="fa fa-user" aria-hidden="true"></i>
                </span>

                <span class='text-muted' style='float:right' title= {{ empty($loan->lenders->count()) ? 'No loan taker' :''  }} data-toggle="tooltip" data-placement="left" >
                  <i class="fa fa-user-times" aria-hidden="true"></i>                  
                </span>

              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          @endif



      </div>
    </div>
  
