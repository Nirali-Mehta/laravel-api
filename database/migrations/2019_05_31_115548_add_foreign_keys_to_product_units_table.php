<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_units', function(Blueprint $table)
		{
			$table->foreign('product_id', 'product_units_ibfk_1')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('unit_id', 'product_units_ibfk_2')->references('id')->on('units')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_units', function(Blueprint $table)
		{
			$table->dropForeign('product_units_ibfk_1');
			$table->dropForeign('product_units_ibfk_2');
		});
	}

}
