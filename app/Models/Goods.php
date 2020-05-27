<?php
namespace App\Models;

class Goods extends Abstracts\RestApiModel
{
	const CHANNEL = 3;

    protected static $apiMap = [
        'retrieve' => ['method' => 'GET', 'path' => 'goods/details'],
    ];

    public static function retrieve($id)
    {
        $params = ['id' => $id, 'channel' => self::CHANNEL];
        return static::getItem('retrieve', $params);
    }


    protected static function getBaseUri()
    {
        return env('SKU_CENTER_HOST');
    }

}
