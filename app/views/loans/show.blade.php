@extends('layouts.simple')
@section('content')
  <section class='content'>
    <div class='row'>
      <div class='col-md-12'>
        <h1>Your Loan Applications</h1>
        @if(!empty($the_flash = Session::get('the_flash')))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thank you!</h4>
            {{ $the_flash}}
          </div>
        @endif


        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bookmarks</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>



      </div>
    </div>
  </section>
@stop