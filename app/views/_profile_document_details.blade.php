 <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Required Documents</h3>
            </div>
            <div class="box-body">

             @if(Auth::user()->user_type == 'admin')
              <input type="hidden" value="{{$user->id}}" class="user_id">
              <div class="table-responsive ">
                <table class="table">
                  <tbody>
                  <tr>
                    <th style="width:50%">Income Tax Return</th>
                    <td> 
                      @if( !count($user->itr) )
                      @else
                        @if( $user->itr[0]->status == 'pending' )
                         
                        <a href="{{ $user->itr[0]->file_path}}" class="view-document fancy-box"><i class="fa fa-eye"></i> view </a>
                        &nbsp;&nbsp;
                        <button class="btn btn-primary btn-sm document-approved" data-file-id="{{$user->itr[0]->id}}"> Approved </button>
                        <button class="btn btn-warning btn-sm document-declined" data-file-id="{{$user->itr[0]->id}}"> Declined </button>
                        @else
                         <span class="label label-success"> {{$user->itr[0]->status}} </span>
                       @endIf
                      @endIf

                    </td>

                  </tr>
                  <tr>
                    <th>Certificate Of Employment</th>
                   <td> 
                      @if( !count($user->coe) )
                        
                      @else
                        @if( $user->coe[0]->status == 'pending' )
                         <a href="{{ $user->coe[0]->file_path}}" class="view-document fancy-box"><i class="fa fa-eye"></i> view </a>
                        &nbsp;&nbsp;
                        <button class="btn btn-primary btn-sm document-approved" data-file-id="{{$user->coe[0]->id}}"> Approved </button>
                        <button class="btn btn-warning btn-sm document-declined"  data-file-id="{{$user->coe[0]->id}}"> Declined </button>
                        @else
                         <span class="label label-success"> {{$user->coe[0]->status}} </span>
                       @endIf
                      @endIf

                    </td>
                  </tr>
                  <tr>
                    <th>Goverment ID</th>
                   <td> 
                      @if( !count($user->goverment_id) )
                        
                      @else
                       @if( $user->goverment_id[0]->status == 'pending' )
                        <a href="{{ $user->goverment_id[0]->file_path }}" class="view-document fancy-box"><i class="fa fa-eye" ></i> view</a>
                        &nbsp;&nbsp;
                        <button class="btn btn-primary btn-sm document-approved" data-file-id="{{$user->goverment_id[0]->id}}"> Approved </button>
                        <button class="btn btn-warning btn-sm document-declined"  data-file-id="{{$user->goverment_id[0]->id}}"> Declined </button>
                      @else
                         <span class="label label-success"> {{$user->goverment_id[0]->status}} </span>
                       @endIf
                      @endIf

                    </td>
                  </tr>
                  <tr>
                    <th>Payslip</th>
                   <td> 
                        @if( !count($user->payslip) )
                        
                      @else
                       @if( $user->payslip[0]->status == 'pending' )
                        <a href="{{ $user->payslip[0]->file_path }}" class="view-document fancy-box"><i class="fa fa-eye fancy-box"></i> view</a>
                        &nbsp;&nbsp;
                        <button class="btn btn-primary btn-sm document-approved" data-file-id="{{$user->payslip[0]->id}}"> Approved </button>
                        <button class="btn btn-warning btn-sm document-declined"  data-file-id="{{$user->payslip[0]->id}}"> Declined </button>
                       @else
                         <span class="label label-success"> {{$user->payslip[0]->status}} </span>
                       @endIf
                      @endIf

                    </td>
                  </tr>
                   <tr>
                    <th>Bills Payment</th>
                   <td> 
                       @if( !count($user->bills_payment) )
                        
                      @else
                      @if( $user->bills_payment[0]->status == 'pending' )
                        <a href="{{ $user->bills_payment[0]->file_path }}" class="view-document fancy-box"><i class="fa fa-eye"></i> view</a>
                        &nbsp;&nbsp;
                        <button class="btn btn-primary btn-sm document-approved" data-file-id="{{$user->bills_payment[0]->id}}"> Approved </button>
                        <button class="btn btn-warning btn-sm document-declined"  data-file-id="{{$user->bills_payment[0]->id}}"> Declined </button>
                       @else
                         <span class="label label-success"> {{$user->bills_payment[0]->status}} </span>
                       @endIf
                      @endIf

                    </td>
                  </tr>
                </tbody>
                </table>
                </div>
               
             @else

                 {{ Form::open( array('route' => 'profile.store','class'=>'form-horizontal','enctype'=>'multipart/form-data') ) }} 
                 
                  <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Income Tax Return</label>
                    <div class="col-sm-8">
                      @if( !count($user->itr) )
                        {{ Form::file('itr','',['class'=>'form-control']) }}
                      @else
                        <span class="label label-warning"> {{$user->itr[0]->status}} </span>
                      @endIf

                    </div>
                  </div>

                   <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Certificate Of Employment</label>
                    <div class="col-sm-8">
                      @if( !count($user->coe) )  
                        {{ Form::file('coe','',['class'=>'form-control']) }}
                       @else
                        <span class="label label-warning"> {{$user->coe[0]->status}} </span>
                      @endIf
                    </div>
                  </div>

                   <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Goverment ID</label>
                    <div class="col-sm-8">
                       @if( !count($user->goverment_id) )  
                        {{ Form::file('goverment_id','',['class'=>'form-control']) }}
                       @else
                        <span class="label label-warning"> {{$user->goverment_id[0]->status}} </span>
                      @endIf
                    </div>
                  </div>

                 <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Payslip</label>
                    <div class="col-sm-8">
                       @if( !count($user->payslip) )  
                        {{ Form::file('payslip','',['class'=>'form-control']) }}
                       @else
                        <span class="label label-warning"> {{$user->payslip[0]->status}} </span>
                      @endIf
                    </div>
                  </div>

                  <div class="form-group">
                   <label for="inputName" class="col-sm-4 control-label">Bills Payment</label>
                    <div class="col-sm-8">
                       @if( !count($user->bills_payment) )  
                        {{ Form::file('bills_payment','',['class'=>'form-control']) }}
                       @else
                        <span class="label label-warning"> {{$user->bills_payment[0]->status}} </span>
                      @endIf
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-12">
                      <button type="submit" class="btn btn-danger"><i class="fa fa-upload"></i> Upload </button>
                    </div>
                  </div>

                  <div>
                    <p><i><b>Note:</b> Admin will review the uploaded documents before approval.</i></p>
                  </div>

                {{ Form::close() }}

            @endIf
             
            </div>
          </div>
