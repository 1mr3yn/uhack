$(document).ready(function(){
  
  //initialize slider
  $(".amount_spinner").each(function(i,el){
    
    var s = $(el);
    s.spinner({
      min: 0,
      numberFormat:'n',
      max: s.data('max'),
      step: s.data('max') / 10,
      spin: function( event, ui ) {
        var target = $( s.data('target'))
        target.html("");

        var button = $(s.data('target')).parents('tr').find("button");
        button.toggleClass('hidden',true);
        if(ui.value > 0 && ui.value <= s.data('max')) {
          var add_on = ui.value * (1.2 / 100);
          var num = (((ui.value / s.data('term')) + add_on ) * s.data('term') ) - ui.value; 
          target.html(num.toLocaleString());
          button.toggleClass('hidden',false);

        }        
      }
    });
  });

  $("button.picker").click(function(e){
    //send ajax data 
    //build params
    var spinner = $(this).parents('tr').find('.amount_spinner')


    var params = {
      'amount'  : spinner.spinner('value'), // the amount invested,
      'loan_id' : spinner.data('loan_id') 
    };

    $.post("/lender/lend",params,function(r){
      if(r.success){
        $("#available_balance").hide().html(r.available_balance).fadeIn('slow');
      }else{
        alert(r.message);
      }
    });
  });

});
