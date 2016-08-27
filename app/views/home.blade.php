@extends('layouts.simple')
@section('content')

 <section class="content-header">
        <h1>
          Glend
          <small>v 1.0</small>
        </h1>
</section>

<section class="content">
 <div class="row"> 
    <hr>
     <div class="col-md-6 col-sm-6 col-xs-12">
     <a href="{{ url('/register') }}">
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">&nbsp;</span>
            <span class="info-box-number">Registration</span>
          </div>
        </div>
    </a>
   </div>


   <div class="col-md-6 col-sm-6 col-xs-12">
    <a href="{{ url('/login') }}">
     <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-lock"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">&nbsp;</span>
        <span class="info-box-number">Login</span>
      </div>
    </div>
   </a>
  </div>
 </div>
</section>

@stop