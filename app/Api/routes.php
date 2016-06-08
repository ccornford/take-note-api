<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Api\V1\Controllers'
], function ($api) {
    $api->get('groups', 'GroupController@index');
    $api->get('groups/{groupId}', 'GroupController@show');
    $api->post('groups', 'GroupController@create');
    $api->put('groups/{groupId}', 'GroupController@update');
    $api->delete('groups/{groupId}', 'GroupController@destroy');
});