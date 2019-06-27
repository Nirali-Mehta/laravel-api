<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuHasProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_has_products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('menu_id')->index('menu_id');
			$table->integer('product_id')->index('product_id');
			$table->decimal('sale_price', 10, 3);
			$table->boolean('is_in_stock');
			$table->text('meta');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu_has_products');
	}

}
