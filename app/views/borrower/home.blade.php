@extends('layouts.dashboard')
@section('content')
  <section class="content-header">
  <h1>
    Borrower's page
    <small> loan applications, pending loans,etc</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Borrower's page</a></li>
    
  </ol>
</section>
<section class='content'>
  <?php $has_loans = Auth::user()->loans->count();?>
  @if(empty($has_loans))
    <div class='row'>
      <div class='col-md-12'>


        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            
            <h4><i class="icon fa fa-warning"></i>You currently don't have any loan applications</h4>
          <p>Fill up the form below you wish to apply for a loan</p>
                </div>
        
      </div>
    </div>
  
  <div class='row'>
    <div class='col-md-6'>
    {{ Form::open(['route'=> 'loans.store','role'=>'form']) }}
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Loan Application</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            {{Form::label('amount','Amount')}}
            {{Form::text('amount',null,['class'=>'form-control'])}}
            
            
              <div class='help-block '>
                Minimumn: 20,000  Maximum: 200,000
                @if(!empty($errors))
                 <p class='text-danger'> {{ implode($errors->get('amount'),"\n") }}</p>
                @endif
              </div>
            



          </div>

          <div class="form-group">
            {{Form::label('term','Loan Term')}}
            {{
              Form::select('term',[0=>'Select loan term']+Util::terms(),1,['class'=>'form-control'])
            }}
            @if(!empty($errors))
              <div class='help-block '>
                <p class='text-danger'> {{ implode($errors->get('term'),"\n") }}</p>
              </div>
            @endif
          </div>
          <div class="form-group">
            <div align='right'>
              {{ Form::submit('Submit',['class'=>'btn btn-primary'])}}
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    {{ Form::close() }}
    </div>
    <!-- /.left side box -->
    <div class='col-md-6'>
      <div class='box box-primary'>
        <div class="box-header with-border">
          <h3 class="box-title">Payment computation</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body"  id='loan-computation'>
        </div>

      </div>
    </div>
  </div>
  @else
    {{  View::make('loans._show') }}
  @endif

</section>

@stop

@section('scripts')
  {{ HTML::script('js/loans.js') }}
  
@stop