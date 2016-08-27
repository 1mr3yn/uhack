@extends('layouts.simple')
@section('content')
 
 <section class="content">
    <div class="row"> 
     <div class="col-md-12">
        <div class="register-box">
          <div class="register-logo">
            <a href="../../index2.html"><b>G</b>lend</a>
          </div>

          <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            {{ Form::open(array('route' => 'register.store')) }} 

              <div class="form-group has-feedback">
                <input type="text" class="form-control" name="first_name" placeholder="First Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>

               <div class="form-group has-feedback">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>

              <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>

              <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>

              <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
              </div>

              <div class="row">
                <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label>
                      &nbsp;&nbsp;&nbsp;<input type="checkbox"> I agree to the <a href="#">terms</a>
                    </label>
                  </div>
                </div>
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
              </div>

            {{ Form::close() }}

            <a href="{{ url('login') }}" class="text-center">I already have a membership</a>

          </div>
          <!-- /.form-box -->
        </div>
    </div>
  </div>
</section>

@stop