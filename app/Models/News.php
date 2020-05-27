<?php

namespace App\Models;

class News extends JavaRestModel {


    /**
     * 接口请求路由
     * @var array
     */
    static protected $apiMap = [
        'company'         => ['method' => 'GET', 'path' => 'regard/'],
        'byid'            => ['method' => 'GET', 'path' => 'information/detail/:id'],
    ];

    /**
     * 接口请求url
     * @return mixed
     */
    static protected function getBaseUri()
    {
        return env('NEWS_HOST');
    }


    /**
     * 获取关于奇点信息
     * @return null|static
     */
    public function getAbout()
    {
        return static::getItem('company');
    }

    /**
     * 获取关于奇点信息
     * @return null|static
     */
    public function getDetail($id)
    {
        $queryParams = [':id' => $id];
        return static::getItem('byid',$queryParams);
    }

}
