<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration {

	protected $permissions;

	public function __construct()
	{
		$this->permissions = Config::get('roleable::tables.permissions', 'permissions');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->permissions, function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique()->index();
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
		Schema::drop($this->permissions);
	}

}
