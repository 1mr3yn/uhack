$(document).ready(function(){
  //compute loan
  var compute_loan = function(){
    $.get('/loans/compute',$("form").serialize(),function(response){
      if(response.success){
        $("#loan-computation").hide();
        $("#loan-computation").html(response.content);
        $("#loan-computation").fadeIn('normal');

      }
    });  
  };
  compute_loan();

  $("form input,form select").on('change keyup',function(){
    compute_loan();
  });

});
