<?php

use Illuminate\Database\Seeder;
use App\Models\Taggables;

class TaggablesTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('taggables')->delete();

		// TaggableNotesSeeder
		Taggables::create(array(
				'tag_id' => 1,
				'taggable_id' => 1,
				'taggable_type' => 'App\Models\Note'
			));

		// TaggableGroupsSeeder
		Taggables::create(array(
				'tag_id' => 1,
				'taggable_id' => 2,
				'taggable_type' => 'App\Models\Group'
			));
	}
}