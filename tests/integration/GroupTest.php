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

        $users = factory(Group::class, $amountGroups)->create();

        foreach($users as $user)
        {
            $this->json('GET', 'api/groups')
                ->seeJson($user->toArray());
        }

        $response = $this->call('GET', 'api/groups');

        $this->assertCount($amountGroups, json_decode($response->getContent()));

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    function gets_group_with_specific_id()
    {
        $group = factory(Group::class, 1)->create();

        $response = $this->call('GET', "api/groups/{$group->id}");

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    function returns_404_if_group_cant_be_found()
    {
        $group = factory(Group::class, 1)->create();

        $response = $this->call('GET', "api/groups/5");

        $this->assertEquals(404, $response->status());
    }

    /** @test */
    function creates_and_returns_one_new_group()
    {
        $response = $this->call('POST', 'api/groups', ['name' => 'Sally']);

        $this->assertEquals(201, $response->status());
    }
    /** @test */
    function deletes_group_by_id()
    {
        $group = factory(Group::class, 1)->create();

        $response = $this->call('DELETE', "api/groups/{$group->id}");

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    function returns_404_if_cant_find_group_to_delete()
    {
        $group = factory(Group::class, 3)->create();

        $response = $this->call('DELETE', "api/groups/10");

        $this->assertEquals(404, $response->status());
    }
}