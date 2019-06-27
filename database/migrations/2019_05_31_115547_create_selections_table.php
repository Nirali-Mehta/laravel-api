<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSelectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('selections', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('variation_id');
			$table->integer('menu_has_product_id')->index('options_ibfk_1');
			$table->string('title', 191);
			$table->string('slug', 191)->unique('slung');
			$table->text('description', 65535)->nullable();
			$table->boolean('is_default_selected')->nullable();
			$table->boolean('is_weight_verianted');
			$table->boolean('have_relations');
			$table->text('meta')->nullable();
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
		Schema::drop('selections');
	}

}
