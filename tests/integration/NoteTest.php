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

}