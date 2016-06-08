<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration {

	public function up()
	{
		Schema::create('notes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->nullable();
			$table->integer('group_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notes');
	}
}