<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('loans', function(Blueprint $table)
			{
				
				$table->increments('id');
				$table->integer('user_id');
				$table->integer('modified_by');
				$table->integer('term');
				$table->decimal('amount',10,2);
				$table->boolean('status');
				$table->text('remarks');
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
		Schema::drop('loans');
	}

}
