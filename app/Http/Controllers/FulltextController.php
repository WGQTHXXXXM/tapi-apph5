<?php
/**
 * Created by PhpStorm.
 * User: weijinlong
 * Date: 2018/5/17
 * Time: 下午1:09
 */
namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Suite;
use Illuminate\Http\Request;

class FulltextController  extends Controller
{
	public function show(Request $request)
	{
		$type = (string)$request->input('type');
		if (!in_array($type, ['suite', 'goods'])) {
			return view('fulltext', ['fulltext' => '']);
		}
		$id = (string)$request->input('id');
		if (empty($id)) {
			return view('fulltext', ['fulltext' => '']);
		}
		$fieldName = (string)$request->input('field');
		if (empty($fieldName)) {
			$fieldName = 'description';
		}

		if ($type == 'suite') {
			try {
				$suite = Suite::retrieve($id);
				$content = (string)$suite->$fieldName;
			} catch (\Exception $e) {
				$content = '';
			}
		} else if ($type == 'goods') {
			try {
				$goods = Goods::retrieve($id);
				$content = (string)$goods->$fieldName;
			} catch (\Exception $e) {
				$content = '';
			}
		}

        if ($request->route()->named('fulltext.app-h5.show')) {
            $hasPathApph5 = true;
        } else {
            $hasPathApph5 = false;
        }

		return view('fulltext', ['fulltext' => $content, 'hasPathApph5' => $hasPathApph5]);
	}

}
