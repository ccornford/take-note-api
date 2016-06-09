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
    function gets_group_with_id_of_1()
    {
        factory(Group::class, 1)->create();

        $response = $this->call('GET', 'api/groups/{$group->id}');

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    function creates_and_returns_one_new_group()
    {
        $response = $this->call('POST', 'api/groups', ['name' => 'Sally']);

        $this->assertEquals(201, $response->status());
    }
}