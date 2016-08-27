<?php

function sweetAlert($title = null, $text = null, $timer = 1700, $type='info')
{
  
  Session::flash('sweet_alert_text',$text);
  Session::flash('sweet_alert_title',$title);
  Session::flash('sweet_alert_timer',$timer);
  Session::flash('sweet_alert_type' ,$type);


}