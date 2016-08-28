@extends('layouts.admin')
@section('content')
  
    <!-- Main content -->
    <section class="content">
      <div class="row">  
        <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body box-profile">
          
           {{ HTML::image('/img/user4-128x128.jpg','',['class'=>"profile-user-img img-responsive img-circle"]) }}

          <h3 class="profile-username text-center">{{ $user->first_name }}, {{ $user->last_name }}</h3>
          <p class="text-muted text-center"><i class="fa fa-circle text-success"></i> {{ $user->user_type }}</p>
         
         
          <ul class="list-group list-group-unbordered">
           
            <li class="list-group-item">
              <b>Unionbank Account</b><sup class="text-danger"> 50% </sup> 
               
                <a class="pull-right"><i class="{{ $user->bank_account ? 'fa fa-check': 'fa fa-warning' }}"></i> </a>
            </li>

            <li class="list-group-item">
              <b>Income Tax Return</b><sup class="text-danger"> 10% </sup>  
               <a class="pull-right">
                @if( !count($user->itr) ) 
                  <i class="fa fa-warning"></i> 
                @else
                  {{$user->itr[0]->status}}
                @endIf
              </a>
            </li>

            <li class="list-group-item">
              <b>COE</b><sup class="text-danger"> 10% </sup> 
              <a class="pull-right">
                @if( !count($user->coe) ) 
                  <i class="fa fa-warning"></i> 
                @else
                  {{$user->coe[0]->status}}
                @endIf
              </a>
            </li>


            <li class="list-group-item">
              <b>Gov. ID</b><sup class="text-danger"> 10% </sup>  
              <a class="pull-right">
                @if( !count($user->goverment_id) ) 
                  <i class="fa fa-warning"></i> 
                @else
                  {{$user->goverment_id[0]->status}}
                @endIf
              </a>
            </li>


            <li class="list-group-item">
              <b>Payslip</b><sup class="text-danger"> 10% </sup>  
              <a class="pull-right">
                @if( !count($user->payslip) ) 
                  <i class="fa fa-warning"></i> 
                @else
                    {{$user->payslip[0]->status}}
                @endIf
              </a>
            </li>


            <li class="list-group-item">
              <b>Bills</b><sup class="text-danger"> 10% </sup>  
              <a class="pull-right">
                @if( !count($user->bills_payment) ) 
                  <i class="fa fa-warning"></i> 
                @else
                  {{$user->bills_payment[0]->status}}
                @endIf
              </a>
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
                <div class="form-group">
                      <label for="inputName" class="col-sm-8 control-label text-info">
                        <i class="fa fa-warning fa-lg"></i> <i>Not Verified / Inactive</i>
                      </label>
                  </div>
              @else
               <div class="form-group">
                    <label for="inputName" class="col-sm-8 control-label text-success">
                     {{ $user->bank_account }} <i class="fa fa-check fa-lg"></i> <i> ( Verified / Active )</i>
                    </label>
                     @include('_profile_bank_details')
                </div>
              @endIf

            </div>
          </div>
           
           @include('_profile_document_details')


      </div>
    </section>
    <!-- /.content -->

@stop