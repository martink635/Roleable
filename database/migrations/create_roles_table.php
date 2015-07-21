<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    protected $roles;

    public function __construct()
    {
        $this->roles = Config::get('roleable.tables.roles');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->roles, function (Blueprint $table) {
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
        Schema::drop($this->roles);
    }
}
