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
        $( s.data('target')).html(  ui.value );
      }
    });
  })

});
