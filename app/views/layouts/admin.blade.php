<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    @if(isset($title))
      {{ $title }} 
    @else
      Glend
    @endIf
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
 {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}
 {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') }}
 {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') }}
 {{ HTML::style('https://code.jquery.com/ui/1.11.4/themes/ui-darkness/jquery-ui.min.css') }}
 {{ HTML::style('/css/AdminLTE.css') }}
 {{ HTML::style('/css/skins/_all-skins.min.css') }}
 {{ HTML::style('/plugins/sweetalert/sweetalert.css') }}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>G</b>lend</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>G</b>lend</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             {{ HTML::image('/img/user4-128x128.jpg','',['class'=>"user-image"]) }}
              <span class="hidden-xs">{{ Auth::user()->name() }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
               {{ HTML::image('/img/user4-128x128.jpg','',['class'=>"img-circle"]) }}

                <p>
                  {{ Auth::user()->name() }}
                </p>
              </li>

              <li class="user-body">

                @include('_profile_completion')
                <small class="text-danger">Complete your profile, to apply for loans. </small>


              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           {{ HTML::image('/img/user4-128x128.jpg','',['class'=>"img-circle"]) }}
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name() }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{ Auth::user()->user_type }}</a>
        </div>
      </div>
    

     <div class="sidebar-progress">
        @include('_profile_completion')
     </div>


      <ul class="sidebar-menu">
        <li class="header">ACCOUNT DETAILS</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
         <?php $account = Auth::user()->account()   ?>
        @if(!empty($account))
          <li><a href="#">Account number<span class="pull-right "> {{  str_repeat("x", 9).substr($account->account_name,13) }}</span></a></li>
          <li><a href="#">Current Balance<span class="pull-right "> {{ $account->currency." ".number_format($account->current_balance ,2)}}</span></a></li>
          <li><a href="#">Available Balance<span class="pull-right">{{ $account->currency." ".number_format($account->avaiable_balance ,2)}}</span></a></li>               
        @endif





        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016 All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

{{ HTML::script('//js.pusher.com/3.1/pusher.min.js') }}
{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}
{{ HTML::script('/plugins/slimScroll/jquery.slimscroll.min.js') }}
{{ HTML::script('/plugins/fastclick/fastclick.js') }}
{{ HTML::script('/js/app.min.js') }}
{{ HTML::script('/plugins/sweetalert/sweetalert.min.js') }}


@if ( Session::has('sweet_alert_text') )
    <script>
        swal({
            text: "{{ Session::get('sweet_alert_text') }}",
            title: "{{ Session::get('sweet_alert_title') }}",
            timer: "{{ Session::get('sweet_alert_timer') }}",
            type: "{{ Session::get('sweet_alert_type') }}",
        });
    </script>
@endIf



@yield('scripts')

</body>
</html>
