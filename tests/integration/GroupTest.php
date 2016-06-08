<?php

class GroupTest extends TestCase
{
    /** @test */
    function get_all_groups()
    {
        $response = $this->call('GET', 'api/groups');

        $this->assertEquals(200, $response->status());
    }
}