<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSelectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('selections', function(Blueprint $table)
		{
			$table->foreign('menu_has_product_id', 'selections_ibfk_1')->references('id')->on('menu_has_products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('selections', function(Blueprint $table)
		{
			$table->dropForeign('selections_ibfk_1');
		});
	}

}
