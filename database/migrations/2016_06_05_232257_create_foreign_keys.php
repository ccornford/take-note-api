<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('notes', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('taggables', function(Blueprint $table) {
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('notes', function(Blueprint $table) {
			$table->dropForeign('notes_group_id_foreign');
		});
		Schema::table('taggables', function(Blueprint $table) {
			$table->dropForeign('taggables_tag_id_foreign');
		});
	}
}