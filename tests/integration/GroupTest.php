<?php

class GroupTest extends TestCase
{
    /** @test */
    function get_all_groups()
    {
        $response = $this->call('GET', 'api/groups');
        dd($response);

        $this->assertEquals(200, $response->status());

        //$response = $this->client->get('groups');
        //
        //$this->assertEquals(
        //    self::HTTP_OK,
        //    $response->getStatusCode()
        //);
        //
        //$this->markTestIncomplete('add expected return data.');
    }
}