<?php

namespace App\Models;

class App extends JavaRestModel {


    /**
     * 接口请求路由
     * @var array
     */
    static protected $apiMap = [
        'article'            => ['method' => 'GET', 'path' => 'articles/:id'],
    ];

    /**
     * 接口请求url
     * @return mixed
     */
    static protected function getBaseUri()
    {
        return env('APP_HOST');
    }

    /**
     * 获取关于奇点信息
     * @return null|static
     */
    public function getArticle($id)
    {
        $queryParams = [':id' => $id];
        return static::getItem('article',$queryParams);
    }

}
