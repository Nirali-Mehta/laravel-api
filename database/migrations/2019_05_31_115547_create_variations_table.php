<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVariationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('variations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->index('company_id');
			$table->integer('sub_variation_id');
			$table->string('title', 191);
			$table->integer('product_id')->index('product_id');
			$table->string('slug', 191)->unique('slung');
			$table->text('description', 65535)->nullable();
			$table->boolean('is_multi_selected')->nullable();
			$table->boolean('is_default_selected')->nullable();
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
		Schema::drop('variations');
	}

}
