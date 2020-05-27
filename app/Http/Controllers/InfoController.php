<?php
/**
 * Created by PhpStorm.
 * User: weijinlong
 * Date: 2018/5/17
 * Time: 下午1:09
 */
namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;

class InfoController  extends Controller
{
    /**
     * 关于奇点页面
     * @param NewsService $newsService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about(Request $request, NewsService $newsService)
    {
        $company = $newsService->getAbout();
        if ($request->route()->named('info.about.haspath')) {
            $hasPathApph5 = true;
        } else {
            $hasPathApph5 = false;
        }

        return view('info.about',['data' => $company->toArray(), 'hasPathApph5' => $hasPathApph5]);
    }

    /**
     * 隐私政策页面
     */
    public function privacyPolicies(Request $request)
    {
        if ($request->route()->named('info.privacypolicy.haspath')) {
            $hasPathApph5 = true;
        } else {
            $hasPathApph5 = false;
        }

        return view('info.privacypolicies',['hasPathApph5' => $hasPathApph5]);
    }

    /**
     * 用户协议页面
     */
    public function agreements(Request $request)
    {
        if ($request->route()->named('info.agreements.haspath')) {
            $hasPathApph5 = true;
        } else {
            $hasPathApph5 = false;
        }

        return view('info.agreements',['hasPathApph5' => $hasPathApph5]);
    }

}
