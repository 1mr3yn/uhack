<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAttachementsAddStatusApprovedDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attachments', function(Blueprint $table)
		{
			 $table->tinyInteger('status')
             ->default(0)
             ->after('file_path')
             ->comment="0 = pending, -1 = declined, 1 = approved";
        $table->timestamp('approved_at')->after('status');
        $table->integer('approved_by')->after('approved_at');
        $table->string('note')->after('approved_by');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attachments', function(Blueprint $table)
		{
			$table->dropColumn(array('status', 'approved_at', 'approved_by','note'));
		});
	}

}
