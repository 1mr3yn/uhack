<?php

class Loan extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'loans';

  protected $fillable = [
    'user_id',
    'modified_by',
    'term',
    'amount',
    'status',
    'remarks',
    'start_date'
  ];

  public function user(){
    return $this->belongsTo('User');
  }
  public function lenders(){
    return $this->hasMany('LenderLoan');
  }



  public static function validate($input =[]){
    
    $validate = Validator::make($input,[
      'amount'=> "required|integer|min:20000|max:200000", 
      'term'  => "required|integer|max:48"
    ]);
    return $validate;
  }

  //return the monthly amortization
  public function compute($custom_amount = null){
    return Util::compute_loan(!empty($custom_amount) ? $custom_amount : $this->amount,$this->term);
  }

  public function formatted_amount($user_amount = null){
    return number_format( !empty($user_amount) ? $user_amount : $this->amount,2);
  }

  //starts the loan payment
  // at this point the total lend amount is now equal to the loan amount
  // let us notify all lenders and the borrower that the loan will now start
  // 
  public function start(){
    if($this->amount == $this->lenders->sum('amount')){
      foreach($this->lenders as $lender){
        $user= User::find($lender->lender_id);
        $data =['body' => "
          <p>
            Dear {$user->name()},
          </p>
          <p>
            The loan will now start. As a Lender, a total of PHP {$this->formatted_amount($lender->amount)} will be deducted to your account.
          </p>
          <p>
            Thank you,<br>
            GLenda Team
          </p>

        "];
        Mail::send('emails.basic', $data, function($message) use($user){
          $message->to($user->email, $user->name())->subject('Loan start!');
        });  

        //deduct the amount from the lender account via funds transfer
        Util::transfer([
          'source_account'  => $user->account()->account_no,      
          'target_account'  => $this->user->account()->account_no,
          'amount'          => $lender->amount
        ]);
      }

      //send message to borrower      
      $data =['body' => "
          <p>
            Dear {$this->user->name()},
          </p>
          <p>

            Congratulations! The loan will now start. A total of {$this->formatted_amount()} will be credited to your account.
          </p>
          <p>
            Thank you,<br>
            GLenda Team
          </p>

        "];
      $borrower = $this->user;
      Mail::send('emails.basic', $body, function($message) use($borrower){
        $message->to($borrower->email, $borrower->name())->subject('Loan start!');
      });  

      $this->status = 1;
      $this->start_date = date("Y-m-d H:i:s");
      $this->save();



      

    }
  }
  //amount is money invested by the lender..
  public function compute_earning($amount=null){
    $add_on = $amount * (1.2 / 100);
    return ((( $amount / $this->term) + $add_on ) * $this->term ) - $amount;          
  }

  //initiate payment funds transfer
  public function pay(){
    foreach($this->lenders as $lender){
      $user= User::find($lender->lender_id);
      $data =['body' => "
        <p>
          Dear {$user->name()},
        </p>
        <p>
          {$this->user->name()} has transferred an amount of PHP {$this->formatted_amount($lender->amount)} your bank account
          as payment for his Loan.
          .
        </p>
        <p>
          Thank you,<br>
          GLenda Team
        </p>

      "];
      Mail::send('emails.basic', $data, function($message) use($user){
        $message->to($user->email, $user->name())->subject('Loan payment!');
      });  
      //to the borrower..
      $borrower_email =['body' => "
        <p>
          Dear {$this->user->name()},
        </p>
        <p>
          Thank you for paying your loan. {$this->compute_loan($lender->amount)} will be deducted to your account
        </p>
        <p>
          Thank you,<br>
          GLenda Team
        </p>

      "];
      $borrower = $this->user;
      Mail::send('emails.basic', $borrower_email, function($message) use($borrower){
        $message->to($borrower->email, $borrower->name())->subject('Loan payment!');
      });  

      //deduct the amount from the borrower account via funds transfer
      Util::transfer([
        'source_account'  => $this->user->account()->account_no, //borrower's account 
        'target_account'  => $user->account()->account_no, // lender's account
        'amount'          => $this->compute_loan($lender->amount) // the MA
      ]);
    }
  }


}
