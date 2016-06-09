<?php

use Illuminate\Database\Seeder;
use App\Api\V1\Models\Group;

class GroupTableSeeder extends Seeder {

	public function run()
	{
		DB::table('groups')->delete();

		factory(Group::class, 5)->create();
	}
}