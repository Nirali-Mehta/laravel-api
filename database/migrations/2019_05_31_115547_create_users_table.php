<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191);
			$table->string('slug')->unique('slug');
			$table->string('password', 191);
			$table->string('mobile', 15)->unique('mobile');
			$table->string('email', 191)->unique();
			$table->dateTime('email_verified_at')->nullable();
			$table->boolean('is_mobile_valid')->default(0);
			$table->boolean('is_email_valid')->default(0);
			$table->binary('profile_image', 65535)->nullable();
			$table->binary('cover_image', 65535)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->integer('referrer_id');
			$table->string('referrer_type');
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
		Schema::drop('users');
	}

}
