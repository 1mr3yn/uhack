@if ($errors->has())
     <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <!--  <h4><i class="icon fa fa-ban"></i> Oops!</h4> -->
        @foreach ($errors->all() as $error)
            {{ $error }}<br>        
         @endforeach
    </div>
 @endif

