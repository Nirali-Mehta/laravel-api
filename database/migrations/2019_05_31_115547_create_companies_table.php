<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_type_id')->index('company_type_id');
			$table->string('name', 191);
			$table->string('slug', 191)->unique('slug');
			$table->text('about', 65535)->nullable();
			$table->binary('profile_image', 65535)->nullable();
			$table->binary('cover_image', 65535)->nullable();
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
		Schema::drop('companies');
	}

}
