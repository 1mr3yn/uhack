@extends('layouts.simple')
@section('content')
 
 <section class="content">
    <div class="row"> 
     <div class="col-md-12">
        <div class="register-box">
          <div class="register-logo">
            <a href="/"><b>G</b>lend</a>
          </div>

          <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>
             
             @include('_alerts')

            {{ Form::open(array('route' => 'register.store')) }} 

             <div class="form-group has-feedback">
                <span><a href="" class="pull-right"><small>View user type details</small></a></span>
                {{ Form::select('user_type',$user_type,'', ['class'=>'form-control']) }}
              </div>


              <div class="form-group has-feedback">
                {{ Form::text('first_name','',['class'=>'form-control', 'placeholder'=>'First Name']) }}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>

               <div class="form-group has-feedback">
                {{ Form::text('last_name','',['class'=>'form-control', 'placeholder'=>'Last Name']) }}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>

              <div class="form-group has-feedback">
               {{ Form::email('email','',['class'=>'form-control', 'placeholder'=>'Email']) }}
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
                      &nbsp;&nbsp;&nbsp;<input type="checkbox" name="terms"> I agree to the <a href="#">terms</a>
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