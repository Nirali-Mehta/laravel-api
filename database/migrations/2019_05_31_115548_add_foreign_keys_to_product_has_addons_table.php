<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductHasAddonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_has_addons', function(Blueprint $table)
		{
			$table->foreign('product_id', 'product_has_addons_ibfk_1')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_has_addons', function(Blueprint $table)
		{
			$table->dropForeign('product_has_addons_ibfk_1');
		});
	}

}
