<?php

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api', 'middleware' => []], function ($api) {

    $api->get("examples/{id}", 'ExampleController@example')->name('example.retrieve')->where(['id' => '[a-z0-9]{32}']);;

});
