<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('counters', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('branch_id')->index('branch_id');
			$table->integer('menu_id')->index('menu_id');
			$table->string('name', 191);
			$table->string('slug', 191)->unique('slug');
			$table->text('about', 65535)->nullable();
			$table->text('settings')->nullable();
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
		Schema::drop('counters');
	}

}
