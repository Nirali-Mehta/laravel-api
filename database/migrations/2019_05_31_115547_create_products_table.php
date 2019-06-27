<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->index('category_id');
			$table->integer('dietary_preference_id')->index('dietary_preference_id');
			$table->string('title', 191);
			$table->string('slug', 191)->unique('slug');
			$table->text('description', 65535)->nullable();
			$table->string('profile_image', 191)->nullable();
			$table->string('cover_image', 191)->nullable();
			$table->string('hsn_code', 191);
			$table->boolean('is_weighted_varianted')->nullable();
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
		Schema::drop('products');
	}

}
