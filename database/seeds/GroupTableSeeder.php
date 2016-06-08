<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('groups')->delete();

		// GroupsSeeder
		Group::create(array(
				'name' => 'Group 1'
			));
	}
}