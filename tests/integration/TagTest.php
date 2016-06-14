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

}