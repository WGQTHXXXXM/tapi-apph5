<?php

namespace App\Services;
use App\Models\App;

class AppService {

    protected $model;

    /**
     * CommonService constructor.
     * 
     * @param news $news
     */
    public function __construct(App $model)
    {
        $this->model = $model;
    }

    /**
     * 应用资讯详情
     * 
     * @param $id
     * @return mixed
     */
    public function getArticle($id)
    {
        $data = $this->model->getArticle($id);

        return $data;
    }

}
