<?php

use App\Api\V1\Models;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TagTest extends TestCase
{
    use databaseTransactions;

    /** @test */
    function get_all_tags()
    {
        $amountTags = 3;

        $tags = factory(Models\Tag::class, $amountTags)->create();
        foreach($tags as $tag)
        {
            $this->json('GET', 'api/tags')
                ->seeJson($tag->toArray());
        }

        $response = $this->call('GET', 'api/tags');

        $this->assertCount($amountTags, json_decode($response->getContent()));

        $this->assertResponseOk();

    }

    /** @test */
    function gets_tag_with_specific_id()
    {
        $tag = factory(Models\Tag::class, 1)->create();

        $this->json('GET', 'api/tags')
            ->seeJson($tag->toArray());

        $response = $this->call('GET', "api/tags/{$tag->id}");

        $this->assertResponseOk();
    }

    /** @test */
    function returns_404_if_tag_cant_be_found()
    {
        $tag = factory(Models\Tag::class, 1)->create();

        $response = $this->call('GET', "api/tags/5");

        $this->assertResponseStatus(404);
    }

    /** @test */
    function creates_and_returns_one_new_tag()
    {
        $response = $this->call('POST', 'api/tags', ['name' => 'Sally']);

        $this->assertResponseStatus(201);
    }

    /** @test */
    function deletes_tag_by_id()
    {
        $tag = factory(Models\Tag::class, 1)->create();

        $response = $this->call('DELETE', "api/tags/{$tag->id}");

        $this->assertResponseStatus(204);
    }

    /** @test */
    function returns_404_if_cant_find_tag_to_delete()
    {
        $group = factory(Models\Tag::class, 3)->create();

        $response = $this->call('DELETE', "api/tags/10");

        $this->assertResponseStatus(404);
    }

}