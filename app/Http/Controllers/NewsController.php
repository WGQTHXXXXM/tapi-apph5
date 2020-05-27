<?php
/**
 * Created by PhpStorm.
 * User: weijinlong
 * Date: 2018/5/17
 * Time: 下午1:09
 */
namespace App\Http\Controllers;

use App\Services\NewsService;
use App\Services\AppService;
use Illuminate\Http\Request;

class NewsController  extends Controller
{
    /**
     * 获取文章详情
     * @param NewsService $newsService
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, NewsService $newsService, $id)
    {
        if ($request->route()->named('news.detail.haspath')) {
            $hasPathApph5 = true;
        } else {
            $hasPathApph5 = false;
        }

        $detail = $newsService->getDetail($id);
        if(empty($detail->toArray())){
            return view('news.notfound');
        }

        return view('news.detail',['data' => $detail->toArray(), 'hasPathApph5' => $hasPathApph5]);
    }

    /**
     * 文章详情页面
     * 
     * @param Request $request
     * @param AppService $service
     * @param string $id
     * @return mixed
     */
    public function article(Request $request, AppService $service, $id)
    {
        $pathprefix = "";
        if ($request->route()->named('news.article.haspath')) {
            $hasPathApph5 = true;
            $pathprefix = "app-h5/";
        } else {
            $hasPathApph5 = false;
        }

        $detail = $service->getArticle($id);
        if(empty($detail->toArray())){
            return view('news.notfound');
        }

        return view('news.article',['data' => $detail->toArray(), 'hasPathApph5' => $hasPathApph5, 'pathprefix' => $pathprefix]);
    }

    /**
     * 视频文章详情页面
     * 
     * @param Request $request
     * @param NewsService $newsService
     * @param string $id
     * @return mixed
     */
    public function video(Request $request, NewsService $newsService, $id)
    {
        if ($request->route()->named('news.video.haspath')) {
            $hasPathApph5 = true;
        } else {
            $hasPathApph5 = false;
        }

        $detail = $newsService->getDetail($id);
        if(empty($detail->toArray())){
            return view('news.notfound');
        }

        return view('news.video',['data' => $detail->toArray(), 'hasPathApph5' => $hasPathApph5]);
    }

}
