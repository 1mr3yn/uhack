<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLenderLoansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//joining table
		Schema::create('lender_loan', function(Blueprint $table)
			{
				$table->increments('id');
				$table->integer('lender_id');
				$table->integer('loan_id');
				$table->decimal('amount',10,2);
				$table->timestamps();
			});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
