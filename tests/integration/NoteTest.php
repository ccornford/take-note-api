<?php

use App\Api\V1\Models;
use Laravel\Lumen\Testing\DatabaseTransactions;

class NoteTest extends TestCase
{
    use databaseTransactions;

    /** @test */
    function get_all_notes_for_a_group()
    {
        factory(Models\Group::class, 1)->create();
        factory(Models\Note::class, 3)->create(['group_id' => 2]);
        factory(Models\Note::class, 3)->create(['group_id' => 1]);

        $this->json('GET', 'api/groups/1/notes')
            ->seeJson(['group_id' => '1'])
            ->dontSeeJson(['group_id' => '2'])
            ->assertResponseOk();

        $response = $this->call('GET', 'api/groups/1/notes');

        $this->assertCount(3, json_decode($response->getContent()));
    }

    function get_one_note_by_id()
    {
        factory(Models\Group::class, 1)->create();
        factory(Models\Note::class, 3)->create(['group_id' => 2]);
        factory(Models\Note::class, 3)->create(['group_id' => 1]);

        $this->json('GET', 'api/groups/2/notes/2')
            ->seeJson(['group_id' => '2', 'id' => '2'])
            ->dontSeeJson(['group_id' => '1', 'id' => '1'])
            ->assertResponseOk();
    }

    /** @test */
    function creates_and_returns_one_new_note()
    {
        $group = factory(Models\Group::class, 1)->create();

        $this->json('POST', 'api/groups/1/notes', [
            'name' => 'Sally',
            'group_id' => $group->id
        ])->assertResponseStatus(201);
    }

    /** @test */
    function deletes_note_by_id()
    {
        $group = factory(Models\Group::class, 1)->create();
        factory(Models\Note::class, 3)->create(['group_id' => $group->id]);


        $response = $this->call('DELETE', "api/groups/{$group->id}/notes/1");

        $this->assertResponseOk();
    }

}