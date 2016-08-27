@extends('layouts.admin')
@section('content')
<section class='content'>
  <div class='row'>
    <div class='col-md-8'>
      <div class="box">
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
                    <th>Term</th>
                    <th>Status</th>                  
                  </tr>
                  
               
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>













      
        <div class='box box-primary'>
          <div class='box-header'>
              <h3 class="box-title">Loan Applications</h3>
          </div>
          <div class='box-body'>
          
            <div class="list-group">            
              @foreach($loans as $loan)
                <a href="#" class="list-group-item">
                  <h4 class="list-group-item-heading">{{ "Username" }}</h4>
                  <p class="list-group-item-text">...</p>
                </a>
              @endforeach  
            </div>
          </div>
        </div>
      
    </div>
    <div class='col-md-4'>
      <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                {{ HTML::image('img/anon.png','user avatar',['class'=>'img-circle'])}}
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Nadia Carmichael</h3>
              <h5 class="widget-user-desc">Generous Lender</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <?php $account = Util::getAccount("000000010921");  

                ?>
                @if(!empty($account))
                  <li><a href="#">Account number<span class="pull-right "> {{  str_repeat("x", 9).substr($account->account_name,13) }}</span></a></li>
                  <li><a href="#">Current Balance<span class="pull-right "> {{ $account->currency." ".number_format($account->current_balance ,2)}}</span></a></li>
                  <li><a href="#">Available Balance<span class="pull-right">{{ $account->currency." ".number_format($account->avaiable_balance ,2)}}</span></a></li>               
                @endif

                
              </ul>
            </div>
          </div>
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