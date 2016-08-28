@extends('layouts.simple')
@section('content')
 
 <section class="content">
    <div class="row"> 
     <div class="col-md-12">
       
       <div class="login-box">
        <div class="login-logo">
          <a href="/"><b class='text-yellow'>G</b><b class='text-primary'>lend</b></a><br>
          <span class='text-success'>Crowd-sourced Lending</span>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Sign in to start your session</p>

          @include('_alerts')

          {{ Form::open(array('route' => 'login.store')) }} 

            <div class="form-group has-feedback">
              <input type="email" name="email" class="form-control" placeholder="Email">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>
                    &nbsp;&nbsp;&nbsp;<input type="checkbox"> Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>

              <!-- /.col -->
            </div>
          </form>
         
          <a href="#">I forgot my password</a><br>
          <hr>
          <div align='right'>
            <span class='text-primary'>Not yet a member? </span>
            <a class='btn btn-success btn-flat' href="{{ url('register') }}" class="text-center">Register</a>
          </div>

        </div>
        <!-- /.login-box-body -->
      </div>
         
     </div>
    </div>
  </div>
</section>

@stop