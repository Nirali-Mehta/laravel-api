<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBranchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('branches', function(Blueprint $table)
		{
			$table->foreign('branch_type_id', 'branches_ibfk_1')->references('id')->on('branch_types')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('company_id', 'branches_ibfk_2')->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('country_id', 'branches_ibfk_3')->references('id')->on('countries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('state_id', 'branches_ibfk_4')->references('id')->on('states')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('city_id', 'branches_ibfk_5')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('branches', function(Blueprint $table)
		{
			$table->dropForeign('branches_ibfk_1');
			$table->dropForeign('branches_ibfk_2');
			$table->dropForeign('branches_ibfk_3');
			$table->dropForeign('branches_ibfk_4');
			$table->dropForeign('branches_ibfk_5');
		});
	}

}
