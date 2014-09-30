<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionRoleTable extends Migration {

	protected $permission_role;
	protected $permissions;
	protected $roles;

	public function __construct()
	{
		$this->permission_role = Config::get('roleable::tables.permisison_role', 'permission_role');
		$this->permissions = Config::get('roleable::tables.permissions', 'permissions');
		$this->roles = Config::get('roleable::tables.roles', 'roles');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->permission_role, function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('permission_id')->unsigned()->index();
			$table->integer('role_id')->unsigned()->index();
			$table->foreign('permission_id')->references('id')->on($this->permissions)->onDelete('cascade');
			$table->foreign('role_id')->references('id')->on($this->roles)->onDelete('cascade');
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
		Schema::table($this->permission_role, function($table) {
            $table->dropForeign('permission_id');
            $table->dropForeign('role_id');
        });

		Schema::drop($this->permission_role);
	}

}
