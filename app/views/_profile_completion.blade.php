<?php

  $progress = User::progress(Auth::user());
  
?>
 <div class="progress progress-sm">
    <div  
     class="progress-bar  progress-bar-striped {{ $progress < 100 ? 'progress-bar-warning' : 'progress-bar-success'}} " 
     role="progressbar" 
     aria-valuemin="0" 
     aria-valuemax="100" 
     style="width: {{$progress}}%">
   </div>
</div>