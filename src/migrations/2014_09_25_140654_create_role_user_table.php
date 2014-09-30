<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleUserTable extends Migration {

	protected $role_user;
	protected $users;
	protected $roles;
	protected $user_id_type;

	public function __construct()
	{
		$this->role_user = Config::get('roleable::tables.role_user', 'role_user');
		$this->users = Config::get('roleable::tables.users', 'users');
		$this->roles = Config::get('roleable::tables.roles', 'roles');
		$this->user_id_type = Config::get('roleable::user_id_type', 'id');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->role_user, function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->unsigned()->index();

			if ($this->user_id_type === "uuid") {
				$table->string('user_id', 36)->index();
			} else {
				$table->integer('user_id')->unsigned()->index();
			}
			
			$table->string('roleable_id');
			$table->string('roleable_type');

			$table->timestamps();

			$table->foreign('role_id')->references('id')->on($this->roles)->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on($this->users)->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->role_user);
	}

}
