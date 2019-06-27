<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('units', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->index('company_id');
			$table->integer('sub_unit_id')->index('sub_unit_id');
			$table->decimal('sub_unit_value', 11, 10);
			$table->string('name', 191);
			$table->string('slug', 191)->unique('slug');
			$table->string('short_code', 191)->nullable()->unique('short_code');
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
		Schema::drop('units');
	}

}
