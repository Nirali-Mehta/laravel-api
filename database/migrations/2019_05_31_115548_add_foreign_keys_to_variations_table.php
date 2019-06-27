<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVariationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('variations', function(Blueprint $table)
		{
			$table->foreign('product_id', 'variations_ibfk_1')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('company_id', 'variations_ibfk_2')->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('variations', function(Blueprint $table)
		{
			$table->dropForeign('variations_ibfk_1');
			$table->dropForeign('variations_ibfk_2');
		});
	}

}
