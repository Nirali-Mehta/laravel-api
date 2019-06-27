<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branches', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('branch_type_id')->index('branch_type_id');
			$table->integer('company_id')->index('company_id');
			$table->string('name', 191);
			$table->string('slug', 191)->unique('slug');
			$table->string('email', 191);
			$table->string('mobile', 13)->unique('mobile');
			$table->text('about', 65535)->nullable();
			$table->text('settings')->nullable();
			$table->string('profile_image', 191)->nullable();
			$table->string('cover_image', 191)->nullable();
			$table->string('tin_number', 191)->nullable();
			$table->string('pan_number', 20)->nullable();
			$table->string('website', 191)->nullable();
			$table->string('timezone', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('postal_code', 10)->nullable();
			$table->integer('country_id')->index('country_id');
			$table->integer('state_id')->index('state_id');
			$table->integer('city_id')->index('city_id');
			$table->decimal('latitude', 10, 8)->nullable();
			$table->decimal('longitude', 11, 8)->nullable();
			$table->text('meta')->nullable();
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
		Schema::drop('branches');
	}

}
