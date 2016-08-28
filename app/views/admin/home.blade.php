@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Admin Home
         <small>it all starts here</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">  
      
       <div class="col-xs-12">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                 <tr>
                  <th>#</th>
                  <th>User</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Type</th>
                  <th>Profile Completion</th>

                </tr>
                
                <?php $i=1; ?>
                @foreach($users as $user)
                 <tr>
                   <td>{{$i++}}</td>
                   <td><a href="{{ route('user.show',$user->id) }}"> {{ $user->name() }} </a></td>
                   <td>{{ $user->email }} </td>
                   <td> 
                    @if($user->status)
                     <span class="label label-success">Approved</span>
                    @else
                     <span class="label label-warning">Pending</span>
                    @endIf
                   </td>
                   <td> 
                    <span class="{{ $user->user_type == 'borrower' ? 'label label-info' : 'label label-primary' }} ">{{$user->user_type}}</span> 
                   </td>

                   <td>
                     <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-yellow" style="width: 50%"></div>
                    </div>
                   </td>
                </tr>
                @endForeach
               
               
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       
      </div>
    </section>
    <!-- /.content -->

@stop