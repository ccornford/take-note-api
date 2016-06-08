<?php

use Illuminate\Database\Seeder;
use App\Api\V1\Models\Note;

class NoteTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('notes')->delete();

		// NotesSeeder
		Note::create(array(
				'name' => 'Note 1',
				'group_id' => 1
			));
	}
}