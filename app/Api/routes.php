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

    $api->group(['prefix' => 'groups/{groupId}'], function($api) {
        $api->get('notes', 'NoteController@index');
        $api->get('notes/{noteId}', 'NoteController@show');
        $api->post('notes', 'NoteController@create');
        $api->put('notes/{noteId}', 'NoteController@update');
        $api->delete('notes/{noteId}', 'NoteController@destroy');
    });
});