<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->call('GroupTableSeeder');
		$this->command->info('Group table seeded!');

		$this->call('NoteTableSeeder');
		$this->command->info('Note table seeded!');

		$this->call('TagTableSeeder');
		$this->command->info('Tag table seeded!');

		$this->call('TaggablesTableSeeder');
		$this->command->info('Taggables table seeded!');
	}
}