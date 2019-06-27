<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRoleHasPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('role_has_permissions', function(Blueprint $table)
		{
			$table->foreign('permission_id', 'role_has_permissions_ibfk_1')->references('id')->on('permissions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('role_id', 'role_has_permissions_ibfk_2')->references('id')->on('roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('role_has_permissions', function(Blueprint $table)
		{
			$table->dropForeign('role_has_permissions_ibfk_1');
			$table->dropForeign('role_has_permissions_ibfk_2');
		});
	}

}
