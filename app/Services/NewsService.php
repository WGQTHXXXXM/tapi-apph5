<?php

namespace App\Services;
use App\Models\News;

class NewsService {

    protected $news;

    /**
     * CommonService constructor.
     * @param news $news
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * 获取关于奇点信息
     * @return null|static
     */
    public function getAbout()
    {
        $data = $this->news->getAbout();

        return $data;
    }

    /**
     * 获取资讯详情
     * @param $id
     * @return mixed
     */
    public function getDetail($id)
    {
        $data = $this->news->getDetail($id);

        return $data;
    }

}
