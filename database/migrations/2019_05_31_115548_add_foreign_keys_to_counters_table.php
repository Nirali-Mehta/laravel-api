<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCountersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('counters', function(Blueprint $table)
		{
			$table->foreign('branch_id', 'counters_ibfk_1')->references('id')->on('branches')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('menu_id', 'counters_ibfk_2')->references('id')->on('menus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('counters', function(Blueprint $table)
		{
			$table->dropForeign('counters_ibfk_1');
			$table->dropForeign('counters_ibfk_2');
		});
	}

}
