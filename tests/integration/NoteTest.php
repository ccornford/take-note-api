<?php

use App\Api\V1\Models;
use Laravel\Lumen\Testing\DatabaseTransactions;

class NoteTest extends TestCase
{
    use databaseTransactions;

    /** @test */
    function get_all_notes_for_a_group()
    {
        $group = factory(Models\Group::class, 1)->create();

        $notes = factory(Models\Note::class, 3)->create(['group_id' => 1]);
        foreach($notes as $note)
        {
            $this->json('GET', 'api/groups/1/notes')
                ->seeJson(['group_id' => '1']);
        }

        $response = $this->call('GET', 'api/groups/1/notes');

        $this->assertCount(3, json_decode($response->getContent()));

        $this->assertResponseOk();
    }

}