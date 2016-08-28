<?php

class Util {    
  //utility function for array_key exists
  public static function get($needle,$haystack,$otherwise=null){    
    
    //if(empty($haystack)){return;} 
    return array_key_exists($needle,(array)$haystack) ?
      $haystack[$needle] :
      $otherwise;
  }
  public static function terms(){
    return [
      6   =>  '6 months' ,
      12  =>  '1 year (12 months)',
      18  =>  '1 year & 6 months (18 months)',
      24  =>  '2 years (24 months)',
      30  =>  '2 years & 6 months (30 months)',
      36  =>  '3 years (36 months)',
      42  =>  '3 years & 6 months (42 months)',
      48  =>  '4 years (48 months)',
    ];
  }
  public static function commonCurlSettings(){
    return [
     CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "content-type: application/json",
        "x-ibm-client-id: ".Config::get("ubp.client-id"),
        "x-ibm-client-secret: ".Config::get("ubp.client-secret")
      )
    ];
  }

  /**union bank api api wrappers*/

  /**
  * Provides real-time balances and other details pertinent to the account number.
  * @return error or response
  */
  public static function getAccount($account_number = false){
    if(empty($account_number)) {return false;}
    if(!empty($user = Cache::get($account_number))){
      return $user;
    }
    $curl = curl_init();
    curl_setopt_array($curl,Util::commonCurlSettings());
    curl_setopt_array($curl,[CURLOPT_URL => "https://api.us.apiconnect.ibmcloud.com/ubpapi-dev/sb/api/RESTs/getAccount?account_no={$account_number}"]);
     
    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);
    if(empty($error)){


      $user = json_decode($response); 
      if(!empty($user[0]->account_no)){
        
        //cache this user so that we don't frequently visit UBP API
        //this cache must be cleared every time a transfer has been made 
        //or when a payment has been made
        Cache::forever($account_number,$user[0]);
        return $user[0];  
      }
      
    }
    return false;
  }

  public static function transfer($transfer_data = []){
    $curl = curl_init();
    curl_setopt_array($curl,Util::commonCurlSettings());

    $post = array_merge([
      'channel_id'      => 'UHACK_0038', 
      'transaction_id'  => time(),
      'source_account'  => '',      
      'target_account' => '',
      'amount'          => 0,
      'source_currency' => 'php',
      'target_currency' => 'php'      
    ],$transfer_data);
    curl_setopt_array($curl,Util::commonCurlSettings());
    curl_setopt_array($curl,[      
      CURLOPT_URL => "https://api.us.apiconnect.ibmcloud.com/ubpapi-dev/sb/api/RESTs/transfer",
      CURLOPT_CUSTOMREQUEST => "POST",  
      CURLOPT_POSTFIELDS => json_encode($post)
    ]);   

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);
    //remove the cached data for this account so that we may refresh this later 
    Cache::forget($post['source_account']);
    Cache::forget($post['target_account']);
    return [
      'response' => $response,
      'error'    => $error
    ];
  }
  //compute MA
  public static function compute_loan($amount=20000,$terms=12,$interest_rate= 1.2){
    return $amount / $terms + ($amount * ($interest_rate /100 ));
  }  


  // WARNING minimum loan amount is 500,000 so we can't really use this API!
  public static function computeLoan($params=[]){
    if(empty($params)) {return false;}

    $curl = curl_init();

    curl_setopt_array($curl,Util::commonCurlSettings());
    curl_setopt_array($curl, [
      CURLOPT_URL => 
        str_replace(
          array_keys($params), 
          array_values($params),
          "https://api.us.apiconnect.ibmcloud.com/ubpapi-dev/sb/api/Loans/compute?principal=amount&interest=interest_rate&noy=terms"
        )              
      ]
    );

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);
    if(empty($error)){
      return json_decode($response);
    }
    return false;
  }

}