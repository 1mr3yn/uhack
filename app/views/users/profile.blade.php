@extends('layouts.dashboard')
@section('content')
 
 <section class="content-header">
      <h1>
         User Profile
        <small>You must complete all the required details to apply for loans</small>
      </h1>
      <p>
        @include('_alerts')
      </p>
</section>

<section class="content">
 <div class="row">

   <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body box-profile">
          
           {{ HTML::image('/img/user4-128x128.jpg','',['class'=>"profile-user-img img-responsive img-circle"]) }}

          <h3 class="profile-username text-center">{{ $user->first_name }}, {{ $user->last_name }}</h3>
          <p class="text-muted text-center"><i class="fa fa-circle text-success"></i> {{ $user->user_type }}</p>
          <p> @include('_profile_completion') </p>
         
          <ul class="list-group list-group-unbordered">
           
            <li class="list-group-item">
              <b>Unionbank Account</b><sup class="text-danger"> 50% </sup> 
               
                <a class="pull-right"><i class="{{ $user->bank_account ? 'fa fa-check': 'fa fa-warning' }}"></i> </a>
            </li>

            <li class="list-group-item">
              <b>Income Tax Return</b><sup class="text-danger"> 10% </sup>  
              <a class="pull-right"><i class="fa fa-warning"></i> </a>
            </li>

            <li class="list-group-item">
              <b>COE</b><sup class="text-danger"> 10% </sup> 
             <a class="pull-right"><i class="fa fa-warning"></i> </a>
            </li>


            <li class="list-group-item">
              <b>Gov. ID</b><sup class="text-danger"> 10% </sup>  
             <a class="pull-right"><i class="fa fa-warning"></i> </a>
            </li>


            <li class="list-group-item">
              <b>Payslip</b><sup class="text-danger"> 10% </sup>  
             <a class="pull-right"><i class="fa fa-warning"></i> </a>
            </li>


            <li class="list-group-item">
              <b>Bills</b><sup class="text-danger"> 10% </sup>  
             <a class="pull-right"><i class="fa fa-warning"></i> </a>
            </li> 
          </ul>
       
        </div>
      </div>
   </div>

    <div class="col-md-8">

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Unionbank Account Number</h3>
            </div>
           
            <div class="box-body">
             @if(!$user->bank_account) 
               {{ Form::open( array('route' => 'profile.verifyBankAccount','class'=>'form-horizontal') ) }} 
               {{ Form::hidden('user_id', $user->id ) }}
                  <div class="form-group">
                    <div class="col-sm-8 control-label">{{ Form::text('bank_account','',['class'=>'form-control']) }}</div>
                    <div class="col-sm-4">
                      <button type="submit" class="btn btn-danger"><i class="fa fa-lock"></i> Verify</button>
                    </div>
                  </div>
                {{ Form::close() }}
            @else
               <div class="form-group">
                    <label for="inputName" class="col-sm-8 control-label text-success">
                     {{ $user->bank_account }} <i class="fa fa-check fa-lg"></i> <i> ( Verified / Active )</i>
                    </label>
                </div>
            @endIf

            </div>
          </div>

           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Required Documents</h3>
            </div>
           
            <div class="box-body">
               {{ Form::open( array('route' => 'profile.store','class'=>'form-horizontal','enctype'=>'multipart/form-data') ) }} 
                 
                  <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Income Tax Return</label>
                    <div class="col-sm-8">
                      {{ Form::file('itr','',['class'=>'form-control']) }}
                    </div>
                  </div>

                   <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Certificate Of Employment</label>
                    <div class="col-sm-8">
                      {{ Form::file('coe','',['class'=>'form-control']) }}
                    </div>
                  </div>

                   <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Goverment ID</label>
                    <div class="col-sm-8">
                      {{ Form::file('goverment_id','',['class'=>'form-control']) }}
                    </div>
                  </div>

                 <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Payslip</label>
                    <div class="col-sm-8">
                      {{ Form::file('payslip','',['class'=>'form-control']) }}
                    </div>
                  </div>

                  <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Bills Payment</label>
                    <div class="col-sm-8">
                      {{ Form::file('bills_payment','',['class'=>'form-control']) }}
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-12">
                      <button type="submit" class="btn btn-danger"><i class="fa fa-upload"></i> Upload </button>
                    </div>
                  </div>


                {{ Form::close() }}
            </div>
          </div>
      
      </div>

    </div> 
</section>


@stop