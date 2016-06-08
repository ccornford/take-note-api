<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaggablesTable extends Migration {

	public function up()
	{
		Schema::create('taggables', function(Blueprint $table) {
			$table->integer('tag_id')->unsigned();
			$table->integer('taggable_id');
			$table->string('taggable_type', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('taggables');
	}
}