<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMenuHasProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menu_has_products', function(Blueprint $table)
		{
			$table->foreign('menu_id', 'menu_has_products_ibfk_1')->references('id')->on('menus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id', 'menu_has_products_ibfk_2')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('menu_has_products', function(Blueprint $table)
		{
			$table->dropForeign('menu_has_products_ibfk_1');
			$table->dropForeign('menu_has_products_ibfk_2');
		});
	}

}
