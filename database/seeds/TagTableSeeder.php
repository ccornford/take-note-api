<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('tags')->delete();

		// TagsNotesSeeder
		Tag::create(array(
				'name' => 'Tag 1'
			));

		// TagsGroupsSeeder
		Tag::create(array(
				'name' => 'Tag 2'
			));
	}
}