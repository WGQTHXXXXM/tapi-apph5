<?php
namespace App\Models;

class Suite extends Abstracts\RestApiModel
{
    protected static $apiMap = [
        'retrieve' => ['method' => 'GET', 'path' => 'suite/:id'],
    ];

    public static function retrieve($id)
    {
        $params = [':id' => $id];
        return static::getItem('retrieve', $params);
    }


    protected static function getBaseUri()
    {
        return env('SKU_CENTER_HOST');
    }

}
