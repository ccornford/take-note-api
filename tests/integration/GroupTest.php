<?php

use App\Api\V1\Models\Group;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    use databaseTransactions;

    /** @test */
    function get_all_groups()
    {
        $amountGroups = 3;

        $groups = factory(Group::class, $amountGroups)->create();
        foreach($groups as $group)
        {
            $this->json('GET', 'api/groups')
                ->seeJson($group->toArray());
        }

        $response = $this->call('GET', 'api/groups');

        $this->assertCount($amountGroups, json_decode($response->getContent()));

        $this->assertResponseOk();
    }

    /** @test */
    function gets_group_with_specific_id()
    {
        $group = factory(Group::class, 1)->create();

        $this->json('GET', 'api/groups')
            ->seeJson($group->toArray());

        $response = $this->call('GET', "api/groups/{$group->id}");

        $this->assertResponseOk();
    }

    /** @test */
    function returns_404_if_group_cant_be_found()
    {
        $group = factory(Group::class, 1)->create();

        $response = $this->call('GET', "api/groups/5");

        $this->assertResponseStatus(404);
    }

    /** @test */
    function creates_and_returns_one_new_group()
    {
        $response = $this->call('POST', 'api/groups', ['name' => 'Sally']);

        $this->assertResponseStatus(201);
    }

    /** @test */
    function updates_group_name()
    {
        $group = factory(Group::class, 1)->create();

        $response = $this->call('PUT', "api/groups/1", ['name' => 'Name was updated']);

        $this->json('GET', "api/groups/1")
            ->seeJson(['name' => 'Name was updated'])
            ->assertResponseOk();
    }

    /** @test */
    function update_throws_validation_error()
    {
        $group = factory(Group::class, 1)->create();

        $response = $this->call('PUT', "api/groups/1", ['name' => '']);

        $this->assertResponseStatus(422);
    }

    /** @test */
    function deletes_group_by_id()
    {
        $group = factory(Group::class, 1)->create();

        $response = $this->call('DELETE', "api/groups/{$group->id}");

        $this->assertResponseOk();
    }

    /** @test */
    function returns_404_if_cant_find_group_to_delete()
    {
        $group = factory(Group::class, 3)->create();

        $response = $this->call('DELETE', "api/groups/10");

        $this->assertResponseStatus(404);
    }
}