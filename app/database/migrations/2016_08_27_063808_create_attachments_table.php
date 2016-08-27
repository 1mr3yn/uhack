<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('attachments')){

			Schema::create('attachments', function(Blueprint $table)
			{
				$table->increments('id');
				$table->integer('user_id');
				$table->text('file_type');
				$table->text('file_path');

				$table->timestamps();
			});	
		}
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attachments');
	}

}
