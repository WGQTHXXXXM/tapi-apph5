<?php
namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;

class MallController  extends Controller
{
    /**
     * 积分规则页
     */
	public function scorerule(Request $request)
	{
        if ($request->route()->named('mall.scorerule.haspath')) {
            $hasPathApph5 = true;
        } else {
            $hasPathApph5 = false;
        }

		return view('mall.scorerule', ['hasPathApph5' => $hasPathApph5]);
	}

    /**
     * 退换货说明
     */
	public function returnback(Request $request)
	{
        if ($request->route()->named('mall.returnback.haspath')) {
            $hasPathApph5 = true;
        } else {
            $hasPathApph5 = false;
        }

		return view('mall.returnback', ['hasPathApph5' => $hasPathApph5]);
	}
}
